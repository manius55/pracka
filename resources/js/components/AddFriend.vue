<template>
    <div>
        <div class="row justify-content-end">
            <div class="col-2 btn btn-primary" @click="showModal()">
                Dodaj przyjaciela
            </div>
        </div>
        <modal :show="this.show" :key="this.show" @close="showModal()">
            <template #header>
                Dodawanie przyjaciela
            </template>
            <template #body>
                <div class="form-group text-start">
                    <label for="friend">Nick zapraszanego przyjaciela:</label>
                    <input type="text" class="rounded form-control" id="friend" placeholder="wprowadź nick">
                </div>
            </template>
            <template #footer>
                <button
                    class="btn btn-success col-2"
                    @click="sendInvitation()"
                >
                    Zaproś
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
    name: "AddFriend",
    props: {
        show: {
            type: Boolean,
            default: false
        },
        name: {
            type: String,
            default: ''
        },
        users: {
            type: Array,
            default: []
        }
    },
    methods: {
        showModal() {
            this.show = !this.show
        },
        sendInvitation() {
            this.name = document.getElementById('friend').value
            if (this.users.find(x => x.name === this.name)) {
                axios.post(`/invitations/${this.name}`)
            }
            this.showModal()
        }
    }
}
</script>

<style scoped>

</style>
