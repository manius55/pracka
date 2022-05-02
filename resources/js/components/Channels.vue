<template>
    <div>
        <div class="channels-container border">
            <h4>Kanały</h4>
            <ul>
                <li v-for="channel in channels" class="channel" @click="pushToNewLocation(channel.id)">

                    <img
                        :src="'/storage/img/' + channel.image"
                        alt="image" style="height: 20px"
                        class="rounded-circle"
                    >
                    <span class="h5">{{ channel.channel_name }}</span>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
export default {
    name: "Channels",
    props: {
        channels: {
            type: Array,
            default: []
        }
    },
    methods: {
        pushToNewLocation(id) {
            location.href = '/abc/' + id
        }
    }
}
</script>

<style scoped>
.channels-container {
    padding: 16px 0;
    border-right: 1px #e6ecf3;
}

.channel {
    padding: 10px;
    cursor: pointer;
    border-bottom: 1px solid #f0f4f8;
}

ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
}
</style>
