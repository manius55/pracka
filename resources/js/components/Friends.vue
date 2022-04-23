<template>
    <div>
            <div v-for="friend in friends" class="row my-3">
                <div class="col-2 border rounded mx-2" style="text-justify: auto ">
                   <strong class="h5">{{ friend.name }}</strong>
                </div>
                <button class="btn btn-danger col-1" @click="showModal(friend.id)">Usuń</button>
            </div>
        <modal :show="this.show" :friend="this.selectedFriend" :key="this.show" @close="showModal()" >
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
        id: {
            type: Number,
            default: null
        },
        selectedFriend: {
            type: Object,
            default: null
        }
    },
    methods: {
        showModal(id) {
            this.id = id
            this.selectedFriend = this.friends.find(selectedFriend => selectedFriend.id === id)
            console.log(this.selectedFriend)
            this.show = !this.show
        },
    }
}
</script>

<style>

</style>
