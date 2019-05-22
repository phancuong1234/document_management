<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Document;
use App\Models\Message;
use App\Models\User;
use App\Models\MessageAttachments;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\MessageRequest;
use Illuminate\Support\Facades\DB;
use App\Uploaders\Uploader;


class MessageController extends Controller
{
    protected $uploader;

    public function __construct(Uploader $uploader)
    {
        $this->uploader = $uploader;
    }

    public function index()
    {
        $arrMessages = $this->getListMessage();
        $getMessages = DB::table('messages')
            ->join('users', 'users.id', 'messages.sender_id')
            ->select('users.avatar', 'users.name', 'messages.id', 'messages.content', 'messages.is_seen', 'messages.sender_id', 'messages.receiver_id', 'messages.title', 'messages.created_at')
            ->whereIn('messages.id',$arrMessages)
            ->paginate(100);

        return view('message.index', compact('getMessages'));
    }
    public function getListMessage(){
        $arrMessages = array();
        $getMessages = Message::where(['messages.parent_id' => config('setting.parent_id_of_message') ])->get();
        foreach($getMessages as $value ){
            if($value->receiver_id == Auth::user()->id || $value->sender_id == Auth::user()->id){
                array_push($arrMessages, $value->id);
            }
        }

        return $arrMessages;
    }
    public function createHaveUsers($id)
    {
        $users = User::where('id', $id)->pluck('name', 'id');
        return view('message.create2', compact('users'));
    }

    public function create()
    {
        $users = User::where([['id', '!=', Auth::user()->id], ['role', '!=', 1]])->pluck('name', 'id');
        return view('message.create', compact('users'));
    }

    public function seen($id){
        $check = true;
        $messages_seen = Message::where('id',$id)->first();
        if(isset($messages_seen->is_seen)){
            $arrUser = json_decode($messages_seen->is_seen);
            foreach ($arrUser as $value){
                foreach ($arrUser as $value) {
                    if (Auth::user()->id == $value) {
                        $check = false;
                        break;
                    }
                }
                if ($check == true){
                    array_push($arrUser, Auth::user()->id);
                }
                return $arrUser;
            }
        }
        else {
            $arrUser = array();
            array_push($arrUser,Auth::user()->id);
            return $arrUser;
        }
    }

    public function store(MessageRequest $request)
    {
        DB::beginTransaction();
        try {
            $arrUser = array();
            array_push($arrUser,Auth::user()->id);
            $message['sender_id'] = Auth::user()->id;
            $message['title'] = $request->title;
            $message['content'] = $request->content;
            $message['receiver_id'] = $request->receiver;
            $message['is_seen'] = json_encode($arrUser);
            $messageId = Message::insertGetId($message);
            if (isset($request->attachedFiles)) {
                $attachedFiles = $request->only('attachedFiles');
                foreach ($attachedFiles['attachedFiles'] as $key => $file) {
                    MessageAttachments::create([
                        'messages_id' => $messageId,
                        'name' => $this->uploader->saveDocument($file, public_path('upload/files/message')),
                    ]);
                }
            }
            $arrUser = array();
            array_push($arrUser,Auth::user()->id);


            DB::commit();

            return redirect(route('message.index'))->with('alert', 'Tin nhắn đã được gửi');
        } catch (Exception $e) {
            DB::rollBack();

            return redirect(route('message.index'))->with('alert', 'Gửi thất bại, vui lòng kiểm tra lại');
        }
    }
    public function show($id)
    {   $messages_seen = json_encode($this->seen($id));
        Message::find($id)->update(['is_seen' => $messages_seen]);
        $getMessages = DB::table('messages')
            ->join('users', 'users.id', 'messages.sender_id')
            ->select('users.avatar', 'users.name', 'messages.id', 'messages.sender_id', 'messages.content', 'messages.title', 'messages.created_at')
            ->where('messages.id', $id)->first();

        $getReplyMessages = DB::table('messages')
            ->join('users', 'users.id', 'messages.sender_id')
            ->select('users.avatar', 'users.name', 'messages.id', 'messages.content', 'messages.sender_id', 'messages.receiver_id', 'messages.title', 'messages.created_at')
            ->where('messages.parent_id','=', $id )->get();


        $getAttachedFile = MessageAttachments::where('messages_id', $getMessages->id)->get();
        return view('message.show', compact('getMessages', 'getAttachedFile', 'getReplyMessages'));
    }

    public function unseen($id){
        $messageData = Message::where('id',$id)->first();
        $arrUserSeen = json_decode($messageData->is_seen);
        if($messageData->receiver_id == Auth::user()->id){
            if(in_array($messageData->sender_id, $arrUserSeen)){
                $key = array_search($messageData->sender_id, $arrUserSeen);
                array_splice($arrUserSeen, $key,1);
            }
        }

        if($messageData->sender_id == Auth::user()->id){
            if(in_array($messageData->receiver_id, $arrUserSeen)){
                $key = array_search($messageData->receiver, $arrUserSeen);
                array_splice($arrUserSeen, $key,1);
            }
        }

        return $arrUserSeen;
    }

    public function reply($id, MessageRequest $request)
    {

        DB::beginTransaction();
        try {
            $jsonReply = json_encode($this->unseen($id));
            Message::find($id)->update(['is_seen' => $jsonReply]);
            $receiveId = Message::select('sender_id')->where('id', $id)->first();
            $message['sender_id'] = Auth::user()->id;
            $message['title'] = $request->title;
            $message['content'] = $request->content;
            $message['receiver_id'] = $receiveId->sender_id;
            $message['parent_id'] = $id;
            $messageId = Message::insertGetId($message);
            if (isset($request->attachedFiles)) {
                $attachedFiles = $request->only('attachedFiles');
                foreach ($attachedFiles['attachedFiles'] as $key => $file) {
                    MessageAttachments::create([
                        'messages_id' => $messageId,
                        'name' => $this->uploader->saveDocument($file, public_path('upload/files/message')),
                    ]);
                }
            }
            DB::commit();

            return redirect(route('message.show', $id))->with('alert', 'Tin nhắn đã được gửi');
        } catch (Exception $e) {
            DB::rollBack();

            return redirect(route('message.show', $id))->with('alert', 'Gửi thất bại, vui lòng kiểm tra lại');
        }
    }

    public function deleteMulti(Request $request){
        $listID = $request->del;
        Message::whereIn('id', $listID)->delete();

        return redirect(route('message.index'))->with('alert', 'Xoá Thành Công');
    }
}
