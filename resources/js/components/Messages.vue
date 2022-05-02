<template>
    <div>
        <div>
            <ul>
                <li v-for="message in messages" :key="message.id">
                    <div v-if="ifMessageFromUser(message.user.id)">
                        <div class="text-end">
                            <div>
                                <img :src="'/storage/img/' + message.user.image" alt="avatar" style="height: 20px" class="rounded-circle"/>
                                <p class="chat-text">
                                    {{ message.message }}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div v-else>
                        <div class="text-start content-start">
                            <div>
                                <img :src="'/storage/img/' + message.user.image" alt="avatar" style="height: 20px" class="rounded-circle"/>
                                <p class="chat-text">
                                    {{ message.message }}
                                </p>
                            </div>
                            <p>
                                {{ message.message }}
                            </p>
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
    padding: .4rem 1rem;
    -webkit-border-radius: 4px;
    -moz-border-radius: 4px;
    border-radius: 4px;
    background: #ffffff;
    font-weight: 300;
    line-height: 150%;
    position: relative;
}
.chat-avatar {
    margin: 0 0 5px 0;
    display: flex;
    align-items: center;
}
</style>
