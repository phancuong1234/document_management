<div class="item item-green col-lg-4 col-6" id="left-bar">
    <div class="big-sidebar">
        <ul class="big-sidebar-ul">
        @if(Auth::user()->role == config('setting.roles.admin_department'))
            <a href="{{route('document-department.index')}}"><li class="big-li"><span>Văn bản đến đơn vị</span></li></a>
            @php
            $departmentId = App\Models\DepartmentUser::select('department_id')->where('user_id', Auth::user()->id)->first();
            $documents = Illuminate\Support\Facades\DB::table('documents')
            ->join('document_department', 'documents.id', 'document_department.document_id')
            ->where('documents.is_approved', 1)
            ->where('document_department.department_id', $departmentId->department_id)
            ->select('documents.id', 'documents.title')
            ->get();
            @endphp
            <li>
                <ul class="small-ul">
                    @foreach($documents as $key => $document)
                    <a href="{{route('document-department.show',$document->id)}}"><li><i class="fas fa-hand-point-right"></i>&nbsp;<span>{{ $document->title }}</span></li></a>
                    @endforeach
                </ul>
            </li>
        @elseif(Auth::user()->role == config('setting.roles.user'))
            <a href="{{route('document-personal.index')}}"><li class="big-li"><span>Văn bản đến cá nhân</span></li></a>
            @php
                $departmentId = App\Models\DepartmentUser::select('department_id')->where('user_id', Auth::user()->id)->first();
                $documents = Illuminate\Support\Facades\DB::table('documents')
                ->join('document_user', 'documents.id', 'document_user.document_id')
                ->where('document_user.department_id', $departmentId->department_id)->get();
            @endphp
            <li>
                <ul class="small-ul">
                    @foreach($documents as $key => $document)
                    <a href="{{route('document-personal.show',$document->id)}}"><li><i class="fas fa-hand-point-right"></i>&nbsp;<span>{{ $document->title }}</span></li></a>
                    @endforeach
                </ul>
            </li>
        @endif

        <a href="{{route('message.index')}}"><li class="big-li"><span>Tin nhắn đến</span></li></a>
        @php
            $arrMessages = array();
            $getMessages = App\Models\Message::where(['parent_id' => config('setting.parent_id_of_message') ])->get();
            foreach($getMessages as $value ){
                if($value->receiver_id == auth()->user()->id || $value->sender_id == auth()->user()->id){
                    array_push($arrMessages, $value->id);
                }
            }

            $message = App\Models\Message::join('users', 'users.id', 'messages.sender_id')
            ->select('users.avatar', 'users.name', 'messages.id', 'messages.content', 'messages.is_seen', 'messages.sender_id', 'messages.receiver_id', 'messages.title', 'messages.created_at')
            ->whereIn('messages.id',$arrMessages)
            ->limit(5)->get();
        @endphp
            <li>
                <ul class="small-ul">
                    @foreach($message as $key => $message)
                    <a href="{{route('message.show', $message->id)}}"><li><i class="fas fa-hand-point-right"></i>&nbsp;<span>{{ $message->title }}</span></li></a>
                    @endforeach
                </ul>
            </li>
        </ul>
    </div>
</div>
