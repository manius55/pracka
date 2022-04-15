<template>
    <div>
            <div v-for="friend in friends" class="row my-3">
                <div class="col-2 border rounded mx-2" style="text-justify: auto ">
                   <strong class="h5">{{ friend.name }}</strong>
                </div>
                <button class="btn btn-danger col-1">Usuń</button>
            </div>
        <modal :show="true"></modal>
    </div>
</template>

<script>
export default {
    name: "Friends",
    props: {
        friends: Array
    }
}
</script>

<style>

</style>
