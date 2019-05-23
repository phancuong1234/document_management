<template>
    <div class="container-chat">
        <h3 class=" text-center">{{ this.name_user}}</h3>
        <div class="messaging">
            <div class="inbox_msg">
                <div class="inbox_people" style="position: relative">
                    <div class="headind_srch">
                        <div class="search-message1">
                            <label class="search-label">
                                <i class="fas fa-search search-icon"></i>
                                <input type="text" autocomplete="off"  v-model="searchMessage" @click="toggleClass()" @keyup="search()" class="search-message1-input" placeholder="Tìm kiếm tin nhắn" spellcheck="false" aria-label="Tìm kiếm trên Messenger"/>
                            </label>
                        </div>
                        <div class="searchUser" :style="{ display: style }" >
                           <div class="chat_user" v-for="User in list_users">
                               <a href="javascript:void(0)" @click="loadMessageByUsers(User.id)">
                                   <div class="chat_img_in_chat">
                                       <img :src="getPic(User.avatar)" :alt="User.avatar">
                                   </div>
                                   <div class="chat_ib_search">
                                       <span class="name-chat">{{ User.name }}</span>
                                   </div>
                               </a>
                           </div>
                        </div>
                    </div>
                    <div class="inbox_chat">
                        <div class="chat_list" :class="{'selected': room.selected }" v-for="(room, index)  in list_rooms" :key="index" @click="loadMessage(room.room_id,room.user_id)" >
                            <div class="chat_people">
                                <a href="javascript:void(0)" @click="toggleActive(index)">
                                    <div class="chat_img">
                                        <img :src="getPic(room.avatar)" :alt="room.avatar">
                                    </div>
                                    <div class="chat_ib">
                                        <span class="name-chat" :class="{'not_read_yet': checkSeen(room.is_seen,currentUser), 'was_read_name' : room.active }">{{ room.name }}</span>
                                        <span class="chat_date" :class="{'not_read_yet': checkSeen(room.is_seen,currentUser), 'was_read_date' : room.active}" :title="reFormatDate(room.created_at)">{{ reFormatDateTime(room.created_at) }}</span>
                                        <p class="content-chat" :class="{'not_read_yet': checkSeen(room.is_seen,currentUser), 'was_read_chat' : room.active}">{{ room.chat }} </p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mesgs">
                    <div class="msg_history">
                        <ChatItem v-for="(message, index) in list_messages"  :key="index" :send_id="list_messages[index-1]" :pkey="index" :message="message" :getPic="getPic" :reFormatDateTime="reFormatDateTime" :reFormatDate="reFormatDate"></ChatItem>
                    </div>
                    <div class="type_msg" :style="{ display: issetRoom }" >
                        <div class="input_msg_write">
                            <div class="image-preview" v-if="imageData.length > 0">
                                <img v-for="(image, key) in imageData" class="preview" v-bind:ref="'image' +parseInt( key )" src="" >
                                <a href="javascript:void(0)" @click="addFiles()" title="thêm ảnh mới" class="add-New-Files"><i class="far fa-plus-square"></i></a>
                                <a href="javascript:void(0)" class="btn-close-preview"  title="gỡ tất cả các tập tin" @click="clearImgData()"><i class="far fa-times-circle "></i></a>
                            </div>
                            <textarea v-model="message" @keydown.enter.exact.prevent @keyup.enter.exact="sendMessage(room_id,receiver_id)" @keydown.enter.shift.exact="newline" placeholder="gõ tin nhắn..." rows="2" cols="92" class="text-chat" ></textarea>
                            <div class="msg_send_btn_fix">
                               <i class="fas fa-file-image inputfile-img"></i>
                                <input type="file" @change="previewImage" accept="image/*" name="file" ref="files" class="inputfile" multiple>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<style lang="scss" scoped>
    .disabled {
        display: none !important;
    }
    .add-New-Files {
        display: inline-block;
        width: 15%;
        height: 93px;
        background: #e5e7e9;
        vertical-align: top;
        color: inherit;
    }
    .add-New-Files i {
        font-size: 32px;
        margin: 26% 46px;
    }
    .search-label {
        position: relative;

    }
    .search-icon {
        position: absolute;
        top: 8px;
        left: 6px;
        font-size: 16px;
    }
    .btn-close-preview {
        position: absolute;
        top: 0px;
        right: 0px;
        font-size: 20px;
    }
    .msg_send_btn_fix {
        background: #05728f none repeat scroll 0 0;
        border: medium none;
        border-radius: 50%;
        color: #fff;
        cursor: pointer;
        font-size: 17px;
        height: 33px;
        position: absolute;
        right: 0;
        bottom: -50px;
        width: 33px
    }
    .inputfile {
        position: absolute;
        opacity: 0;
        right: 0;
        top: 0;
    }
    .inputfile-img {
        position: absolute;
        top: 20%;
        left: 32%;
    }
    .image-preview {
        margin-top: 10px;
        text-align: left;
        position: relative;
    }
    .preview {
        background: #e5e7e9;
        padding: 10px 10px 5px;
        margin: 0 10px 10px 0;
        width: 20%;
        height: 20%;
    }
    .text-chat {
        margin-top: 10px;
        border: none;
        float: left;
    }
    .mesgs {
        float: left;
        padding: 30px 15px 0 15px;
        width: 70%;
    }
    .name_user_in_chat{
        border-bottom: 1px solid #c4c4c4;
    }
    .searchUser {
        position:absolute;
        width: 100%;
        background-color: white;
        height: 550px;
        overflow-y: scroll;
    }
    .chat_user {
        width: 100%;
        height: 7%;
    }
    .chat_user:hover{
        background-color: #ebebeb;
        border: 1px solid #c4c4c4;
    }
    .chat_ib_search {
        float: left;
        width: 79%;
        margin-left: 5%;
        text-align: left;
        margin-top: 2%;
    }
    .chat_img img{
        width: 43px;
        border-radius: 50%;
        height: 42px;
        max-width: 43px;
        max-height: 42px;
    }
    .chat_img_in_chat img {
        width: 35px;
        border-radius: 50%;
        float: left;
        height: 35px;
        margin-left: 2%;
        margin-top: 2px;
        max-width: 35px;
        max-height: 35px;
    }
    .selected {
        background: rgba(0, 0, 0, .05);
    }
    .not_read_yet {
        color: black;
        font-weight: bold;
    }
    .was_read_name {
        color: inherit;
        font-weight: normal;
    }
    .was_read_date {
        color: rgba(153, 153, 153, 1);
        font-weight: normal;
    }
    .was_read_chat {
        color: rgba(153, 153, 153, 1);
        font-weight: normal;
    }
</style>
<script>
    import moment from 'moment';
    import ChatItem from './ChatItem.vue'
    export default {
        components: {
            ChatItem
        },
        data() {
            return {
                issetRoom: false,
                name_user: '',
                style: 'none',
                list_users: this.loadListUsers(),
                message: '',
                searchMessage: '',
                receiver_id : '',
                room_id: '',
                list_messages: [],
                list_rooms: this.loadRoom(),
                dataOfRoomLoadFirst : [],
                infoOfRoom: '',
                imageData: [],
                currentUser: '',
                list_rooms_id: []
            }
        },
        created() {
            this.checkIssetRoom()
            this.getCurrentUserLogin()
            this.getRoomId()
            this.runFirst()
        },
        mounted () {
            this.csrfToken = document.head.querySelector('meta[name="csrf-token"]').content
            setTimeout(() => {
                // this.joinRoom()
                this.joinRoomNewChat()
                this.scrollToBottom()
            }, 500)

            // sự kiện join tất cả room chat
        },
        methods: {
            checkIssetRoom(){
                if(typeof this.list_rooms == 'undefined'){
                    this.issetRoom = 'none'
                }
                else {
                    this.issetRoom = 'inherit'
                }
            },
            //join room sự kiện tin nhắn mới
            joinRoomNewChat(){
                var id = this.currentUser
                window.Echo.private('roomdefault.' + id)
                    .listen('GetRooms', (data) => {
                        let room = data.getRooms[0]
                        this.list_rooms.push({
                            avatar: room.avatar,
                            chat: room.chat,
                            created_at: room.created_at,
                            is_seen: room.is_seen,
                            name: room.name,
                            room_id: room.room_id,
                            user_id: room.user_id,
                        })
                        this.runFirst()
                    })

            },
            //join room chat 1-1
            joinRoom(){
                this.list_rooms_id.forEach(element => {
                    window.Echo.private('chatroom.' + element.room_id)
                        .listen('PrivateMessage', (e) => {
                            this.list_rooms = e.listRoom
                            let message = e.message
                            message.avatar = e.users.avatar
                            this.list_messages.push(message)
                            this.scrollToBottom()
                        });
                })
            },
            //lay room id cua user hien tai
            getRoomId(){
                axios.get('/get-room-of-current-user')
                    .then(response => {
                        this.list_rooms_id = response.data
                    })
                    .catch(error => {
                        console.log(error)
                    })
            },
            //kiem tra da doc
            checkSeen(userWasSeen,User){
                var check = false
                if(userWasSeen != 0){
                    if(userWasSeen == User){
                        check = false
                    }
                    else {
                        check = true
                    }
                }
                else {
                    check = false
                }
                return check
            },
            getCurrentUserLogin() {
                axios.get('/getUserLogin')
                    .then(response => {
                        this.currentUser = response.data.id
                    })
            },
            //load thông tin chát ngay khi load trang
            runFirst(){
                axios.get('/list-room')
                    .then(response => {
                        this.dataOfRoomLoadFirst = response.data[0]
                        this.room_id = this.dataOfRoomLoadFirst.room_id
                        this.loadMessage(this.dataOfRoomLoadFirst.room_id,this.dataOfRoomLoadFirst.user_id)
                    })
                    .catch(error => {
                        console.log(error)
                    })
                this.checkIssetRoom()
                return this.room_id
            },
            //kiểm tra xem liên hệ có tin nhắn với người gửi chưa
            checkNewMessage(receiver_id){
                axios.get('/check-is-new-chat/'+receiver_id)
                    .then(response => {
                        this.infoOfRoom = response.data
                })
                .catch(error => {
                    console.log(error)
                })
            },
            //load tin nhắn khi click vào liên hệ  trên thanh tìm kiếm
            loadMessageByUsers(receiver_id){
                this.checkNewMessage(receiver_id);
                setTimeout(() => {
                    if(JSON.stringify(this.infoOfRoom).length == 2)
                    {
                        let randomRoomId = this.rndStr(20);
                        this.sendMessage(randomRoomId,receiver_id)
                        this.loadMessage(randomRoomId,receiver_id)
                        this.loadRoom()
                        this.toggleClass()
                    }
                    else {
                        this.loadMessage(this.infoOfRoom.room_id,receiver_id)
                        this.toggleClass()
                    }
                }, 200);
            },
            //load tin nhắn
            loadMessage(id,receiver_id) {
                axios.get('/chats/'+id)
                    .then(response => {
                        this.list_messages = response.data
                        this.room_id = id
                        this.receiver_id = receiver_id
                    })
                    .catch(error => {
                        console.log(error)
                    })
                this.checkIssetRoom()
                this.getName(id)
                // giải pháp hiện tại. chát room nào realtime room đó =(.
                window.Echo.private('chatroom.' + id)
                    .listen('PrivateMessage', (e) => {
                        this.list_rooms = e.listRoom
                        let message = e.message
                        message.avatar = e.users.avatar
                        this.list_messages.push(message)
                        this.scrollToBottom()
                    });
                setTimeout(() => {
                    this.scrollToBottom()
                }, 500)
            },
            // load các phòng chát
            loadRoom() {
                axios.get('/list-room')
                    .then(response => {
                        this.list_rooms = response.data
                    })
                    .catch(error => {
                        console.log(error)
                    })
            },
            //load liên hệ
            loadListUsers() {
                axios.get('/list-user-in-chat')
                    .then(response => {
                        this.list_users = response.data
                    })
                    .catch(error => {
                        console.log(error)
                    })
            },
            //lấy tên người nhận của room
            getName(room_id){
                axios.get('/get-current-user-in-chat/'+ room_id)
                    .then(response => {
                        this.name_user = response.data.name
                    })
                    .catch(error => {
                        console.log(error)
                    })
            },
            //cuộn xuống
            scrollToBottom () {
                const container = document.querySelector('.msg_history')
                if (container) {
                    $(container).animate(
                        { scrollTop: container.scrollHeight},
                        { duration: 'medium', easing: 'swing' }
                    )
                }
            },
            //gửi tin nhắn
            sendMessage(id,receiver_id) {
                axios.post('/chats/'+id+'/'+receiver_id, {
                    message: this.message
                })
                    .then(response => {
                        this.list_messages.push({
                            chat: this.message,
                            created_at: new Date(),
                            sender_id: this.$root.currentUserLogin.id
                        })
                        this.message = ''
                        this.scrollToBottom()
                    })
                    .catch(error => {
                        console.log(error)
                    })
                this.loadRoom()
            },
            // lấy path ảnh
            getPic(index) {
                return '/upload/images/'+index;
            },
            //tìm kiếm
            search(){
                let keyWord;
                if(this.searchMessage == ''){
                    keyWord = 'isNull'
                }
                else {
                    keyWord = this.searchMessage
                }
                axios.get('/search-users-in-chat/'+ keyWord)
                    .then(response => {
                        this.list_users = response.data
                    })
                    .catch(error => {
                        console.log(error)
                    })
            },
            //random chuỗi (random mã phòng chat)
            rndStr(len) {
                let text = ""
                let chars = "abcdefghijklmnopqrstuvwxyz1234567890"

                for( let i=0; i < len; i++ ) {
                    text += chars.charAt(Math.floor(Math.random() * chars.length))
                }

                return text
            },
            //sự kiện đóng mở danh sách liên hệ của tin nhắn
            toggleClass(){
                if(this.style == "none"){
                    this.style = "block"
                }
                else {
                    this.style = "none"
                }
            },
            //sự kiện chọn / không chọn ( css hover )
            toggleActive(index) {
                this.list_rooms.forEach(function (value, key) {
                   if(key != index){
                       let item = value;
                       item.selected = false
                   }
                });
                let item = this.list_rooms[index];
                item.selected = true
                item.active = true
                this.$set(this.list_rooms, index, item)
            },
            // parse date dạng string 'DD - MM - YYYY' về dạng date stardard
            parseDate(input) {
                var parts = input.split('/');
                return new Date(parts[2], parts[1]-1, parts[0]);
            },
            // lấy thứ ngày
            getNameDay(day) {
                if (day == 0) return 'CN';
                else if (day == 1) return 'T2';
                else if (day == 2) return 'T3';
                else if (day == 3) return 'T4';
                else if (day == 4) return 'T5';
                else if (day == 5) return 'T6';
                return 'T7';
            },
            // format ngày theo định dạng 'dd-mm-yyyy'
            reFormatDate(created_at){
                return moment(created_at).format('DD-MM-YYYY')
            },
            // format ngày theo định dạng có thứ ngày 'dd-mm'
            reFormatDateTime(created_at){
                var now = moment(new Date().toISOString().slice(0,10));
                var dateOfChat = moment(created_at).format('YYYYMMDD');
                var dateDiff  = now.diff(dateOfChat, 'days')
                var dateWantToParse = moment(created_at).format('DD/MM/YYYY');
                var dateParse = this.parseDate(dateWantToParse)
                var weekday = dateParse.getDay();
                var weekdayName = this.getNameDay(weekday);
                if(dateDiff > 365){
                    return moment(created_at).format('DD-MM-YYYY')
                }
                else if(dateDiff >= 1) {
                    return weekdayName +' '+ moment(created_at).format('DD-MM')
                }
                else {
                    return moment(created_at).format('H:mm')
                }
            },
            newline() {
                this.value = `${this.value}\n`;
            },
            previewImage(e) {
                var selectedFiles = e.target.files;
                for (var i=0; i < selectedFiles.length; i++){
                    this.imageData.push(selectedFiles[i]);
                }
                for( let i = 0; i < this.imageData.length; i++ ){
                    /*
                      Ensure the file is an image file
                    */
                    if ( /\.(jpe?g|png|gif)$/i.test( this.imageData[i].name ) ) {
                        /*
                          Create a new FileReader object
                        */
                        let reader = new FileReader();

                        /*
                          Add an event listener for when the file has been loaded
                          to update the src on the file preview.
                        */
                        reader.addEventListener("load", function(){
                            this.$refs['image'+parseInt( i )][0].src = reader.result;
                        }.bind(this), false);

                        /*
                          Read the data for the file in through the reader. When it has
                          been loaded, we listen to the event propagated and set the image
                          src to what was loaded from the reader.
                        */
                        reader.readAsDataURL( this.imageData[i] );
                    }
                }
            },
            addFiles(){
                this.$refs.files.click();
            },
            clearImgData(){
                this.imageData = []
            },
            uploadImage(){
                axios.post('/image/store',{imageData: this.imageData}).then(response => {
                    if (response.data.success) {
                        alert(response.data.success);
                    }
                });
            }
        }
    }
</script>
