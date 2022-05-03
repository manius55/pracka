<template>
    <span @keyup.enter="addMessage()">
        <input name="message" class="form-control" placeholder="Wpisz wiadomość" v-model="newMessage">
        <button class="btn btn-primary" @click="addMessage()">Wyślij</button>
    </span>
</template>

<script>

export default {
    name: "NewMessage",
    props: {
        user: Object,
        channel_id: {
            type: Number,
            default: 0
        }
    },
    data() {
        return {
            newMessage: "",
        };
    },
    methods: {
        addMessage() {
            this.$emit('messagesent', {
                user: this.user,
                message: this.newMessage,
                channel_id: this.channel_id
            });
            this.newMessage = "";
        }
    }
}
</script>

<style scoped>

</style>
