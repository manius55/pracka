<template>
    <div>
        <div id="AlertPlaceholder"></div>
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
                    Czy na pewno chcesz zaprosić użytkownika <strong>{{ name }}</strong> ?
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
    name: "AddSpecificFriend",
    props: {
        show: {
            type: Boolean,
            default: false
        },
        name: {
            type: String,
            default: ''
        },
        friends: {
            type: Array,
            default: []
        },
        invitations: {
            type: Array,
            default: []
        },
        invited: {
            type: Array,
            default: []
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
        sendInvitation() {
                let userIsFriend = this.friends.find(x => x.id === this.id) ?? false
                let userAlreadyInvited = this.invited.includes(this.id) ?? false
                let userInvitedMe = this.invitations.includes(this.id) ?? false

                if (userIsFriend) {
                    this.alert('Użytkownik już jest na liście przyjaciół!', 'danger')
                }
                else if (userAlreadyInvited) {
                    this.alert('Użytkownik został już wcześniej zaproszony!', 'danger')
                }
                else if (userInvitedMe) {
                    this.alert('Zaproszenie od danego użytkownika oczekuja na twoją akceptację', 'danger')
                }
                else {
                    axios.post(`/invitations/${this.name}`)
                    this.invited.push(this.id)
                    this.alert('Wysłano zaproszenie!', 'success')
                }
                this.showModal()
        },
        alert(message, type) {
            let alertPlaceholder = document.getElementById('AlertPlaceholder')
            let alertDiv = document.createElement('div')
            alertDiv.innerHTML = '<div class="alert alert-' + type + ' alert-dismissible" role="alert">' + message + '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>'

            alertPlaceholder.append(alertDiv)
        }
    }
}
</script>

<style scoped>

</style>
