<template>
 <div>
     <div v-for="user in users" class="row my-3">
         <div class="mx-2" v-if="currentUser(user.id)">
             <span class="col-3 border rounded" style="text-justify: auto ">
                    <img :src="'https://pracka-images.s3.eu-central-1.amazonaws.com/images/' + user.image" alt="avatar" style="height: 20px" class="rounded-circle"/>
                    <strong class="h5">{{ user.name }}</strong>
             </span>
             <span v-if="editPrivileges(user.id)" style="font-size: 10px"> Admin <input type="checkbox" v-model="user.admin" @click="changeAdminStatus(user.id)"></span>
             <button class="btn btn-danger btn-sm" @click="showModal()" v-if="editPrivileges(user.id)">Usuń</button>
             <modal :show="show">
                 <template #header>
                     Usuwanie użytkownika z kanału
                 </template>
                 <template #body>
                     <div class="form-group text-start">
                         Czy na pewno chcesz usunąć z kanału tego użytkownika ?
                     </div>
                 </template>
                 <template #footer>
                     <button
                         class="btn btn-success col-2"
                         @click="deleteUserFromChannel(user.id)"
                     >
                         Potwierdź
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
     </div>
 </div>
</template>

<script>
export default {
    name: "ChannelUsers",
    props: {
        users: {
            type: Array,
            default() {
                return []
            }
        },
        id: {
            type: Number,
            default: 0
        },
        channel: {
            type: Number,
            default: 0
        },
        show: {
            type: Boolean,
            default: false
        }
    },
    methods: {
        currentUser(id) {
            if (this.id !== id) {
                return true
            }
            return false
        },
        editPrivileges(id) {
            let currentUser = this.users.find(x => x.id === this.id)
            let user = this.users.find(x => x.id === id)

            if (currentUser && currentUser.owner === true)
                return true
            if (user.admin === false)
                return true
            return false

        },
        changeAdminStatus(id) {
            axios.put(`/channel/${this.channel}/user/${id}`)
        },
        showModal() {
            this.show = !this.show
        },
        deleteUserFromChannel(id) {
            axios.delete(`/channel/${this.channel}/user/${id}`)
            this.showModal()
            location.reload()
        },
    }
}
</script>

<style scoped>

</style>
