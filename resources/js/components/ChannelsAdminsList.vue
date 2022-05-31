<template>
    <div>
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">Id kanału</th>
                <th scope="col">Nazwa kanału</th>
                <th scope="col">Avatar kanału</th>
                <th scope="col">Nick administratora</th>
                <th scope="col">Właściciel kanału</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="channel in channels">
                <th scope="col">{{ channel.id }}</th>
                <th scope="col">{{ channel.channel_name }}</th>
                <th>                        <img
                    :src="'https://pracka-images.s3.eu-central-1.amazonaws.com/images/' + channel.image"
                    alt="image" style="height: 20px; width: 20px"
                    class="rounded-circle"
                ></th>
                <th scope="col">{{ channel.user_name }}</th>
                <th scope="col">{{ channel.owner }}</th>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
export default {
    name: "ChannelsAdminsList",
    props: {
        channels: {
            type: Array,
            default: []
        }
    }
}
</script>

<style scoped>

</style>
