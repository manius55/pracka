<template>
    <div>
        <div v-for="user in users" class="row my-3">
            <div class="col-2 border rounded mx-2" style="text-justify: auto ">
                <strong class="h5">{{ user.name }}</strong>
            </div>
            <button class="btn btn-danger col-1" @click="cancel(user.id)">Cofnij zaproszenie</button>
        </div>
    </div>
</template>

<script>
export default {
    name: "MyInvitationsList",
    props: {
        users: Array,
        id: {
            type: Number,
            default: null
        }
    },
    methods: {
        cancel(id){
            console.log('wykonuje się')
            axios.delete(`/myInvitations/${id}`)
            location.reload()
        }
    }
}
</script>

<style scoped>

</style>
