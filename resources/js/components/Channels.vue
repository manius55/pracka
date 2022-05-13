<template>
    <div>
        <div class="channels-container border">
            <h4 style="padding: 10px">Kanały</h4>
            <ul>
                <li v-for="channel in channels" class="channel" @click="pushToNewLocation(channel.id)">
                    <div v-if="choosenChannel(channel.id)" style="background: #efefef;">
                        <img
                            :src="'https://pracka-images.s3.eu-central-1.amazonaws.com/images/' + channel.image"
                            alt="image" style="height: 20px; width: 20px"
                            class="rounded-circle"
                        >
                        <span class="h5">{{ channel.channel_name }}</span>
                    </div>
                    <div v-else>
                        <img
                            :src="'https://pracka-images.s3.eu-central-1.amazonaws.com/images/' + channel.image"
                            alt="image" style="height: 20px; width: 20px"
                            class="rounded-circle"
                        >
                        <span class="h5">{{ channel.channel_name }}</span>
                    </div>
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
        },
        id: {
            type: Number,
            default: 0
        }
    },
    methods: {
        pushToNewLocation(id) {
            location.href = '/channel/' + id
        },
        choosenChannel(id) {
            if (id === this.id) {
                return true
            }
            return false
        }
    },
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
