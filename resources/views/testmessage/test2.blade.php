@extends('layouts.user.message_master')
@section('title')
    Văn bản đến cá nhân
@endsection
@section('content')
<div class="container-chat">
    <h3 class=" text-center">Tin Nhắn</h3>
    <div class="messaging">
        <div class="inbox_msg">
            <div class="inbox_people">
                <div class="headind_srch">
                        <div class="search-message1">
                            <label>
                                <input autocomplete="off" class="search-message1-input" placeholder="Tìm kiếm tin nhắn" spellcheck="false" type="text" aria-label="Tìm kiếm trên Messenger" value="">
                            </label>
                        </div>
                </div>
                <div class="inbox_chat">
                    <div class="chat_list active_chat">
                        <div class="chat_people">
                            <div class="chat_img">
                                <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil">
                            </div>
                            <div class="chat_ib">
                                <span class="name-chat">Sunil Rajput</span>
                                <span class="chat_date">25-5</span>
                                <p class="content-chat">Test, which is a new approach to have all solutions
                                astrology under one roof.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mesgs">
                <div class="msg_history">
                    <div class="incoming_msg">
                        <div class="incoming_msg_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div>
                        <div class="received_msg">
                            <div class="received_withd_msg">
                                <p>Test which is a new approach to have all solutions</p>
                                <span class="time_date" title="21-11-2019">11:01 AM</span></div>
                        </div>
                    </div>
                    <div class="incoming_msg">
                        <div class="incoming_msg_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div>
                        <div class="received_msg">
                            <div class="received_withd_msg">
                                <p>Test which is a new approach to have all
                                    solutions</p>
                                <span class="time_date"> 11:01 AM</span></div>
                        </div>
                    </div>
                    <div class="outgoing_msg">
                        <div class="sent_msg">
                            <span class="time_date2"> 11:01 AM </span>
                            <p>Test which is a new approach to have all solutionsTest which is a new approach to have all solutionsTest which is a new approach to have all solutionsTest which is a new approach to have all solutionsTest which is a new approach to have all solutions</p>
                        </div>
                    </div>
                </div>
                <div class="type_msg">
                    <div class="input_msg_write">
                        <input type="text" class="write_msg" placeholder="Type a message" />
                        <button class="msg_send_btn" type="button"><i class="fa fa-paper-plane-o" aria-hidden="true"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection