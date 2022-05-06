<template>
    <div>
        <div id="AlertPlaceholder"></div>
        <div class="row justify-content-end">
            <div class="col-2 btn btn-primary" @click="showModal()">
                Dodaj użytkownika
            </div>
        </div>
        <modal :show="this.show" :key="this.show" @close="showModal()">
            <template #header>
                Dodawanie użytkownika do kanału
            </template>
            <template #body>
                <div class="form-group text-start">
                    <label for="user">Nick dodawanego użytkownika:</label>
                    <input type="text" class="rounded form-control" id="user" name="user" placeholder="wprowadź nick" :value="name">
                </div>
            </template>
            <template #footer>
                <button
                    class="btn btn-success col-2"
                    @click="addUser()"
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
    name: "AddUser",
    props: {
        show: {
            type: Boolean,
            default: false
        },
        users: {
            type: Array,
            default() {
                return []
            }
        },
        channel_users: {
            type: Array,
            default() {
                return []
            }
        },
        id: {
            type: Number,
            default: 0
        }
    },
    data() {
        return {
            name: ''
        }
    },
    methods: {
        showModal() {
            this.show = !this.show
        },
        addUser() {
            this.name = document.getElementById('user').value
            let user = this.users.find(x => x.name === this.name)

            if (user) {
                let UserAlreadyAtChannel = this.channel_users.find(x => x.user_id === user.id && x.channel_id === this.id)
                if (UserAlreadyAtChannel) {
                    this.alert('Użytkownik już jest na kanale!', 'danger')
                }
                else {
                    this.alert('Użytkownik dodany do kanału!', 'success')
                    axios.post(`/channel/addUser/${this.id}/${user.id}`)
                    this.channel_users.push({'channel_id': this.id, 'user_id': user.id})
                }
            }
            else {
                this.alert('Nie znaleziono użytkownika!', 'danger')
            }
            this.showModal()
            this.name = ''
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
