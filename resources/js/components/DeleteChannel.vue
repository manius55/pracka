<template>
    <div>
        <button class="btn btn-danger" @click="showModal()">Usuń kanał</button>
        <modal :show="this.show" :key="this.show" @close="showModal()" @confirm="deleteFriend(selectedFriend.id)" >
            <template #header> Usuwanie kanału</template>
            <template #body>
                <div class="h5">
                    Czy na pewno chcesz usunąć kanał?
                </div>
            </template>
            <template #footer>
                <button
                    class="btn btn-success col-2"
                    @click="deleteChannel()"
                >
                    Tak
                </button>

                <button
                    class="btn btn-danger col-2"
                    @click="showModal()"
                >
                    Anuluj
                </button>
            </template>
        </modal>
    </div>
</template>

<script>
export default {
    name: "DeleteChannel",
    props: {
        show: {
            type: Boolean,
            default: false
        },
        id: {
            type: Number,
            default: 0
        }
    },
    methods: {
        showModal() {
            this.show = !this.show
        },
        deleteChannel() {
            axios.delete(`/channel/${this.id}`)
            this.showModal()
            location.href = '/channel'
        }
    },
}
</script>

<style scoped>

</style>
