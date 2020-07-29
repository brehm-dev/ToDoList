<template>
    <div class="container" style="width: 32em">
        <div class="row">
            <p class="text-center">Do you want to delete User: {{user.email}} ?</p>
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
    import { bus } from "../../app";

    export default {
        data: function () {
            return {}
        },
        props: {
            route: {
                type: Object
            },
            user: {
                type: Object
            }
        },
        methods: {
            acceptDelete() {
                window.axios({
                    method: this.route.method,
                    url: this.route.action.replace('{user}', this.user.id)
                }).then(response => {
                    if (response.data.deleted === true) {
                        bus.$emit('redirect-component', {route: 'Index'})
                    }
                }).catch(e => {
                    console.log(e)
                })
            },
            discardDelete() {
                bus.$emit('redirect-component', {route: 'Index'})
            }
        }
    }

</script>
