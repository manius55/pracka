<template>
    <div>
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Nazwa kanału</th>
                <th scope="col">Avatar</th>
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
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
export default {
    name: "ChannelsList",
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
