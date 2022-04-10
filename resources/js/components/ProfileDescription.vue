<template>
    <div>
        <div class="container">
            <div class="text-center">
                    <label for="description">Description</label>
                <div>
                    <textarea id="description" rows="4" readonly draggable="false" style="resize: none;width: 600px" > {{ profile.description }} </textarea>
                </div>
            </div>
        </div>
    </div>
</template>

<script>


export default {
    name: "ProfileDescription",
    props: {
        profile: Object,
        width: String
    },
    created() {
    },
}
</script>

<style scoped>

</style>
