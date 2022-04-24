<template>
    <div :key="keyRender">
            <div v-for="friend in friends" class="row my-3">
                <div class="col-2 border rounded mx-2" style="text-justify: auto ">
                   <strong class="h5">{{ friend.name }}</strong>
                </div>
                <button class="btn btn-danger col-1" @click="showModal(friend.id)">Usuń</button>
            </div>
        <modal :show="this.show" :key="this.show" @close="showModal()" @confirm="deleteFriend(selectedFriend.id)" >
            <template #header> Usuwanie Przyjaciela</template>
            <template #body> Czy na pewno chcesz usunąć z przyjaciół użytkownika <strong>{{ selectedFriend.name }}</strong> ? </template>
        </modal>
    </div>
</template>


<script>

export default {
    name: "Friends",
    props: {
        friends: Array,
        show: {
            type: Boolean,
            default: false
        },
        selectedFriend: {
            type: Object,
            default: null
        }
    },
    methods: {
        showModal(id) {
            this.selectedFriend = this.friends.find(selectedFriend => selectedFriend.id === id)
            this.show = !this.show
        },
        deleteFriend(id) {
            axios.delete(`/friends/${id}/delete`)
            this.show = !this.show
            this.$emit('confirm')
            location.reload()
        },
        render() {
            this.keyRender++
        }
    },
    data() {
        return {
            keyRender: 0
        }
    }
}
</script>

<style>

</style>
