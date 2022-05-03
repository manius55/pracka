<template xmlns="http://www.w3.org/1999/html">
    <div>
        <div>
            <ul>
                <li v-for="message in messages" :key="message.id">
                    <div v-if="ifMessageFromUser(message.user.id)">
                        <div class="text-end">
                            <div>
                                <small>{{ formatDate(message.created_at) }}</small>
                                <img :src="'/storage/img/' + message.user.image" alt="avatar" style="height: 20px" class="rounded-circle"/> <ab
                                <p class="chat-text">
                                    <strong>{{ message.message }}</strong>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div v-else>
                        <div class="text-start content-start">
                            <div>
                                <img :src="'/storage/img/' + message.user.image" alt="avatar" style="height: 20px" class="rounded-circle"/>
                                <small>{{ formatDate(message.created_at) }}</small>
                                <p class="chat-text">
                                    <strong>{{ message.message }}</strong>
                                </p>
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
        }
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
                console.log(Date)
            }
            else {
                DateTime = date.split('T')

                Date = DateTime[0]
                Date = Date.split('-')
                Date = Date.reverse()
                Date = Date.join('-')
                console.log(Date)
                Time = DateTime[1].split(':')
            }

            return Time[0] + ':' + Time[1] + ' ' + Date
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
.chat-text {
    color: #444;
    padding: 12px 14px;
    line-height: 8px;
    font-size: 15px;
    border-radius: 8px;
    display: inline-block;
    position: relative;
    background: #efefef;
}
.chat-avatar {
    margin: 0 0 5px 0;
    display: flex;
    align-items: center;
}
</style>
