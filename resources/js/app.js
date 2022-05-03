/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('friends', require('./components/Friends.vue').default);
Vue.component('modal', require('./components/Modal.vue').default);
Vue.component('invitations-list', require('./components/InvitationsList.vue').default);
Vue.component('my-invitations-list', require('./components/MyInvitationsList.vue').default);
Vue.component('add-friend', require('./components/AddFriend.vue').default);
Vue.component('add-specificfriend', require('./components/AddSpecificFriend.vue').default);
Vue.component('new-message', require('./components/NewMessage.vue').default);
Vue.component('messages', require('./components/Messages.vue').default);
Vue.component('channels', require('./components/Channels.vue').default);
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    data: {
        messages: []
    },
    created() {
        this.messagesWithUser();
        window.Echo.private('channel')
            .listen('MessageSent', (e) => {
                this.messages.push({
                    message: e.channelMessage.message,
                    channel_id: e.channelMessage.channel_id,
                    user: e.user
                });
            });
    },
    methods: {
        messagesWithUser() {
            axios.get('/messages').then(response => {
                this.messages = response.data;
            });
        },
        newMessage(message, channel_id) {
            this.messages.push(message);
            axios.post('/messages', message, channel_id)
        }
    }
});
