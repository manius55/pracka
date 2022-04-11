<template>
    <div>
        <div class="container border">
            <div class="col-md gy-5">
                <div class="row justify-content-center py-4">
                    <label for="description" class="col-1 py-5 px-0 h5"><strong>Description:</strong></label>
                    <div id="description" class="border col-6 border border-dark rounded"> <strong>{{ profile.description }} </strong> </div>
                    <div class="col-1"></div>
                </div>
                <div class="row justify-content-start">
                    <div class="col-2"></div>
                    <label for="date_of_birth" class="col-1 py-2 px-0 h5"><strong>Date of birth:</strong></label>
                    <div id="date_of_birth" class="col-1 py-2 border text-center border-dark rounded">{{profile.date_of_birth}}</div>
                    <div class="col-1"></div>
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
        var date = this.profile.date_of_birth
        var newDate = new Date(date)
        console.log(newDate.getMonth()+1)
        console.log(typeof newDate)
    }
}
</script>

<style scoped>

</style>
