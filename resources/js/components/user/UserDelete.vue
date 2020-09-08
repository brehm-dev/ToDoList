<template>
    <div class="container" style="width: 32em">
        <div class="row">
            <p class="text-center">Do you want to delete User: {{user.username}} ?</p>
        </div>
        <div class="row">
            <div class="col-sm">
                <button class="btn btn-success" @click="acceptDelete">Accept</button>
            </div>
            <div class="col-sm">
                <button class="btn btn-danger" @click="discardDelete">Discard</button>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data: function () {
            return {}
        },
        beforeMount() {
            this.$parent.setComponent({
                current: 'UserDelete',
                form: true
            })
            if (this.$route.params.hasOwnProperty('user')) {
                this.user = this.$route.params.user
            }
        },
        methods: {
            acceptDelete() {
                this.$parent.delete(this.$route.fullPath)
            },
            discardDelete() {
                this.$router.push({ name: 'UserIndex'})
            }
        }
    }

</script>
