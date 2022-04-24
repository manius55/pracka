<template>
    <div>
        <div v-for="user in users" class="row my-3">
            <div class="col-2 border rounded mx-2" style="text-justify: auto ">
                <strong class="h5">{{ user.name }}</strong>
            </div>
            <button class="btn btn-success col-1" @click="confirm(user.id)">Akceptuj</button>
            <button class="btn btn-danger col-1" @click="cancel(user.id)">Odrzuć</button>
        </div>
    </div>
</template>

<script>
export default {
    name: "InvitationsList",
    props: {
        users: Array,
        id: {
            type: Number,
            default: null
        }
    },
    methods: {
        confirm(id){
            axios.put(`/invitations/${id}`)
            axios.post(`/friends/${id}`)
            location.reload()
        },
        cancel(id){
            axios.delete(`/invitations/${id}`)
            location.reload()
        }
    }
}
</script>

<style scoped>

</style>
