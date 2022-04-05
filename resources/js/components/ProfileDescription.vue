<template>
    <div>
        {{ profile.description }}
    </div>
</template>

<script>


export default {
    name: "ProfileDescription",
    props: {
        profile: Object
    },
    created() {

    }
}
</script>

<style scoped>

</style>
