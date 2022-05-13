<template xmlns="http://www.w3.org/1999/html">
    <div>
        <div>
            <ul class="overflow-auto" style="height: 600px; flex-direction: column-reverse; display: flex;">
                <li v-for="message in messages" :key="message.id">
                    <div v-if="isChannelMessage(message.channel_id)">
                        <div v-if="ifMessageFromUser(message.user.id)">
                            <div class="text-end">
                                <div>
                                    <span style="font-size: 10px">{{ formatDate(message.created_at) }}</span>
                                    <span @click="routeToUserProfile(message.user.id)">
                                        <strong>{{ message.user.name }}</strong>
                                        <img :src="'https://pracka-images.s3.eu-central-1.amazonaws.com/images/' + message.user.image" alt="avatar" style="height: 20px; width: 20px" class="rounded-circle"/>
                                    </span>
                                </div>
                                <div class="chat-text">
                                    <strong>{{ message.message }}</strong>
                                </div>
                            </div>
                        </div>
                        <div v-else>
                            <div class="text-start content-start">
                                <div>
                                    <span @click="routeToUserProfile(message.user.id)">
                                        <img :src="'https://pracka-images.s3.eu-central-1.amazonaws.com/images/default.png'" alt="avatar" style="height: 20px; width: 20px" class="rounded-circle"/>
                                        <strong>{{ message.user.name }}</strong>
                                    </span>
                                    <span style="font-size: 10px">{{ formatDate(message.created_at) }}</span>
                                </div>
                                <div class="chat-text">
                                    <strong>{{ message.message }}</strong>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
export default {
    name: "Messages",
    props: {
        messages: {
            type: Array,
            default: []
        },
        id: {
            type: Number,
            default: 0
        },
        channel: {
            type: Number,
            default: 0
        },
    },
    methods: {
        ifMessageFromUser(id) {
            if (this.id === id) {
                return true
            }
                return false
        },
        formatDate(date) {
            let Time
            let Date
            let DateTime
            if (date === undefined) {
                date = new window.Date().toLocaleString();

                DateTime = date.split(',')
                Date = DateTime[0]
                Time = DateTime[1].replace(/\s/g, '');
                Time = Time.split(':')
                Date = Date.replaceAll(/\./g, '-')
            }
            else {
                DateTime = date.split(" ")
                Date = DateTime[0]
                Time = DateTime[1].split(':')
            }

            return Time[0] + ':' + Time[1] + ' ' + Date
        },
        isChannelMessage(id) {
            if (this.channel === id) {
                return true
            }
            return false
        },
        routeToUserProfile(id) {
            location.href = '/profile/' + id
        },
    },
    data() {
        return {
            reverse_messages: []
        }
    }
}
</script>

<style scoped>
ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
}
li {
    padding: 5px;
}
.chat-text {
    color: #444;
    padding: 8px 20px;
    line-height: 5px;
    font-size: 15px;
    border-radius: 8px;
    display: inline-block;
    position: relative;
    background: #efefef;
}
</style>
