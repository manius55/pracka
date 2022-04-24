<template>
    <div>
        <div v-for="user in users" class="row my-3">
            <div class="col-2 border rounded mx-2" style="text-justify: auto ">
                <strong class="h5">{{ user.name }}</strong>
            </div>
            <button class="btn btn-success col-1">Akceptuj</button>
            <button class="btn btn-danger col-1">Odrzuć</button>
        </div>
    </div>
</template>

<script>
export default {
    name: "InvitationsList",
    props: {
        users: Array
    },
    methods: {
        confirm(){

        },
        cancel(){

        }
    }
}
</script>

<style scoped>

</style>
