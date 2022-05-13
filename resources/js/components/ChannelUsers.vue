<template>
 <div>
     <div v-for="user in users" class="row my-3">
             <span class="col-2 border rounded mx-2" style="text-justify: auto " v-if="currentUser(user.id)">
                    <img :src="'https://pracka-images.s3.eu-central-1.amazonaws.com/images/' + user.image" alt="avatar" style="height: 20px" class="rounded-circle"/>
                    <strong class="h5">{{ user.name }}</strong>
             </span>
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
        }
    },
    methods: {
        currentUser(id) {
            if (this.id !== id) {
                return true
            }
            return false
        }
    }
}
</script>

<style scoped>

</style>
