<template>
    <span>
        <input name="message" class="form-control" placeholder="Wpisz wiadomość" v-model="newMessage">
        <button class="btn btn-primary" @click="addMessage()" @keyup.enter="addMessage()">Wyślij</button>
    </span>
</template>

<script>
import newMessage from "./NewMessage";

export default {
    name: "NewMessage",
    props: {
      user: Object,
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
                message: this.newMessage
            });
            this.newMessage = "";
        }
    }
}
</script>

<style scoped>

</style>
