<template>
<div>
    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Nick</th>
            <th scope="col">Avatar</th>
            <th scope="col">Mail</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="user in users">
            <th scope="col">{{ user.id }}</th>
            <th scope="col">{{ user.name }}</th>
            <th>                        <img
                :src="'https://pracka-images.s3.eu-central-1.amazonaws.com/images/' + user.image"
                alt="image" style="height: 20px; width: 20px"
                class="rounded-circle"
            ></th>
            <th scope="col">{{ user.email }}</th>
        </tr>
        </tbody>
    </table>
</div>
</template>

<script>
export default {
    name: "UsersList",
    props: {
        users: {
            type: Array,
            default: []
        }
    }
}
</script>

<style scoped>

</style>
