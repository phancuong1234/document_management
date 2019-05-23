<template>
    <div>
        <div class="incoming_msg" v-if="message.sender_id != $root.currentUserLogin.id">
            <div class="incoming_msg_img img-chat">
                <img :src="getPic(message.avatar)" :title="message.name" v-if="check(message.sender_id) == false">
            </div>
            <div class="received_msg">
                <div class="received_withd_msg">
                    <p>{{ message.chat }} </p>
                    <span class="time_date" :title="reFormatDate(message.created_at)">{{ reFormatDateTime(message.created_at) }}</span>
                </div>
            </div>
        </div>
        <div class="outgoing_msg" v-if="message.sender_id == $root.currentUserLogin.id">
            <div class="sent_msg">
                <span class="time_date2":title="reFormatDate(message.created_at)">{{ reFormatDateTime(message.created_at) }} </span>
                <p>{{ message.chat }}</p>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['pkey', 'message', 'send_id', "getPic", "reFormatDateTime", "reFormatDate"],
        methods: {
            check(id){
                if(typeof this.send_id == 'undefined'){
                    return false;
                }
                else if(this.send_id.sender_id == id){
                    return true;
                }
                else {
                    return false;
                }
            }
        }
    }
</script>
<style lang="scss" scoped>
    .img-chat {
        width: 4% !important;
    }
    .img-chat img {
        max-height: 32px;
        max-width: 32px;
        border-radius: 50%;
        height: 32px;
        width: 32px;
    }
    .outgoing_msg {
        overflow: hidden;
        margin:0 !important;
    }
</style>