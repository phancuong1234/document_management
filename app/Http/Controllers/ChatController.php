<?php

namespace App\Http\Controllers;

use App\Events\GetRooms;
use App\Events\PrivateMessage;
use App\Models\Chat;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Events\MessagePosted;
class ChatController extends Controller
{
    public function index(){
        return view('chat.index');
    }
    //load tin nhắn theo room ID
    public function loadMessage($roomId){
        $dataMessage = Chat::join('users','chats.sender_id', '=', 'users.id')
            ->select('users.avatar', 'users.name', 'chats.*')
            ->where('chats.room_id', $roomId)->get();
        $dataOfRoom = Chat::where('room_id', $roomId)->orderBy('id', 'desc')->first();
        if(isset($dataOfRoom['is_seen']) && $dataOfRoom['is_seen'] != Auth::user()->id){
            $dataOfRoom->update(['is_seen' => 0]);
        }
        else {
            $dataOfRoom->update(['is_seen' => Auth::user()->id]);
        }
//        Chat::where('room_id', $roomId)->update(['is_seen' => Auth::user()->id]);

        return $dataMessage;
    }
    //lấy tên của người nhận đang chat hiện tại
    public function getNameOfCurrentUserChat($roomId){
        $data = Chat::where('room_id', $roomId)->first();
        if($data->sender_id == Auth::user()->id){
            $data = Chat::join('users','chats.receiver_id', '=', 'users.id')
                ->select('users.avatar', 'users.name')
                ->where('chats.room_id', $roomId)
                ->first();
        }
        if($data->receiver_id == Auth::user()->id){
            $data = Chat::join('users','chats.sender_id', '=', 'users.id')
                ->select('users.avatar', 'users.name')
                ->where('chats.room_id', $roomId)
                ->first();
        }

        return $data;
    }
    //lay danh sach room chat
    public function listRoom(){
        //lọc room có chưa user_id và người nhận
        $listRoomHaveCondition = Chat::where('chats.sender_id',Auth::user()->id)
            ->orWhere('chats.receiver_id', Auth::user()->id)
            ->select('room_id')
            ->distinct('chats.room_id')
            ->get();
        $arrRoom = array();
        $newArrRoom = array();
        //tạo mảng room đã lọc lấy id cuộc trò chuyện cuối cùng
        foreach( $listRoomHaveCondition as $value) {
            $chatData = Chat::where('room_id',$value->room_id)->orderBy('id', 'desc')->first();
            array_push($arrRoom, $chatData->id);
        }
        //lấy dữ liệu các room đã lọc
        $dataOfRoom = Chat::whereIn('chats.id', $arrRoom)->get();
        foreach( $dataOfRoom as $value){
            if($value->sender_id == Auth::user()->id){
                $dataUser =  User::where('id',$value->receiver_id)->first();
                $reData['avatar'] = $dataUser->avatar;
                $reData['name'] = $dataUser->name;
                $dataChat = Chat::where('chats.id',$value->id)->first();
                $reData['chat'] = $dataChat->chat;
                $reData['is_seen'] = $dataChat->is_seen;
                $reData['user_id'] = $dataUser->id;
                $reData['room_id'] = $dataChat->room_id;
                $reData['created_at'] =$value->created_at;
                array_push($newArrRoom, $reData);
            }
            if($value->receiver_id == Auth::user()->id) {
                $dataUser =  User::where('id',$value->sender_id)->first();
                $reData['avatar'] = $dataUser->avatar;
                $reData['name'] = $dataUser->name;
                $dataChat = Chat::where('chats.id',$value->id)->first();
                $reData['chat'] = $dataChat->chat;
                $reData['is_seen'] = $dataChat->is_seen;
                $reData['user_id'] = $dataUser->id;
                $reData['room_id'] = $dataChat->room_id;
                $reData['created_at'] = $value->created_at;
                array_push($newArrRoom, $reData);
            }

        }

       return $newArrRoom;
    }
    //load room co parameter
    public function loadRoomById($roomId){
        //lọc room có chưa user_id và người nhận
        $listRoomHaveCondition = Chat::where('chats.sender_id',$roomId)
            ->orWhere('chats.receiver_id', $roomId)
            ->distinct('chats.room_id')
            ->get();
        $arrRoom = array();
        $newArrRoom = array();
        //tạo mảng room đã lọc lấy id cuộc trò chuyện cuối cùng
        foreach( $listRoomHaveCondition as $value) {
            $chatData = Chat::where('room_id',$value->room_id)->orderBy('id', 'desc')->first();
            array_push($arrRoom, $chatData->id);
        }
        //lấy dữ liệu các room đã lọc
        $dataOfRoom = Chat::whereIn('chats.id', $arrRoom)->get();
        foreach( $dataOfRoom as $value){
            if($value->sender_id == $roomId){
                $dataUser =  User::where('id',$value->receiver_id)->first();
                $reData['avatar'] = $dataUser->avatar;
                $reData['name'] = $dataUser->name;
                $dataChat = Chat::where('chats.id',$value->id)->first();
                $reData['chat'] = $dataChat->chat;
                $reData['is_seen'] = $dataChat->is_seen;
                $reData['user_id'] = $dataUser->id;
                $reData['room_id'] = $dataChat->room_id;
                $reData['created_at'] = $value->created_at;
                array_push($newArrRoom, $reData);
            }
            if($value->receiver_id == $roomId) {
                $dataUser =  User::where('id',$value->sender_id)->first();
                $reData['avatar'] = $dataUser->avatar;
                $reData['name'] = $dataUser->name;
                $dataChat = Chat::where('chats.id',$value->id)->first();
                $reData['chat'] = $dataChat->chat;
                $reData['is_seen'] = $dataChat->is_seen;
                $reData['user_id'] = $dataUser->id;
                $reData['room_id'] = $dataChat->room_id;
                $reData['created_at'] = $value->created_at;
                array_push($newArrRoom, $reData);
            }

        }

        return $newArrRoom;
    }
    //gửi tin nhắn
    public function sendMessage(Request $request, $roomId, $receiveId){
        if(!isset($request->message)){
            $message = 'Xin chào.';
        }
        else{
            $message = $request->message;
        }
        $content['receiver_id'] = $receiveId;
        $content['chat'] = $message;
        $content['sender_id'] = Auth::user()->id;
        $content['room_id'] = $roomId;
        $createMessage = Chat::create($content);
        Chat::where('room_id', $roomId)->update(['is_seen' => Auth::user()->id]);
        if(!isset($request->message)) {
            $getRooms = $this->loadNewRoom($createMessage->chat,
                $createMessage->is_seen, $createMessage->room_id,
                $createMessage->created_at);
            broadcast(new GetRooms($getRooms, $receiveId))->toOthers();
        }
        $message = Chat::join('users','chats.sender_id', '=', 'users.id')
            ->select('users.avatar', 'users.name', 'chats.*')
            ->where('chats.sender_id', Auth::user()->id)
            ->orderBy('chats.id','desc')
            ->first();
        $listRoom = $this->loadRoomById($receiveId);
        broadcast(new PrivateMessage($message, $roomId, $listRoom))->toOthers();



        return ['status' => 'OK'];
    }
    //tìm kiếm liên hệ
    public function  searchUser($keyWord){
        if($keyWord == 'isNull'){
            $dataMessage =   User::where([['id','!=',Auth::user()->id],['role', '!=', 1]])->get();
        }
        else
        {
            $dataMessage =  User::where('name','LIKE', "%{$keyWord}%")->get();
        }

        return $dataMessage;
    }
    //kiểm tra new chat
    public function checkNewChat($receiver_id){
        $data = Chat::where(['sender_id' => Auth::user()->id,'receiver_id' => $receiver_id])->first();
        if($data == null){
            $data = Chat::where(['sender_id' => $receiver_id,'receiver_id' => Auth::user()->id])->first();
        }
        return $data;
    }
    //danh sach liên hệ
    public function listUserInChat(){
        $dataOfUsers = User::where([['id','!=',Auth::user()->id],['role', '!=', 1]])->get();

        return $dataOfUsers;
    }
    //lấy danh sách room của user hiện tại
    public function getRoomOfCurrentUser(){
        $roomData = Chat::where('sender_id',Auth::user()->id)
            ->orWhere('receiver_id', Auth::user()->id)
            ->select('room_id')
            ->distinct('room_id')
            ->get();

        return $roomData;
    }
    //xử lý khi gửi đi 1 room mới.
    public function loadNewRoom($chat,$is_seen,$room_id,$created_at){
        $newArrRoom = array();
        $dataUser =  User::where('id',Auth::user()->id)->first();
        $reData['avatar'] = $dataUser->avatar;
        $reData['name'] = $dataUser->name;
        $reData['chat'] = $chat;
        $reData['is_seen'] = $is_seen;
        $reData['user_id'] = $dataUser->id;
        $reData['room_id'] = $room_id;
        $reData['created_at'] = $created_at;
        array_push($newArrRoom, $reData);

        return $newArrRoom;
    }
}
