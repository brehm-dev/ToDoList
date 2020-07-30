<template>
    <component
        :is="current"
        v-bind="switchInstance"
        v-bind:router="router"
    ></component>
</template>

<script>
    import User from './User';
    import Schedule from './Schedule';
    import {bus} from '../app'

    export default {
        name: 'instance-loader',
        data: function () {
            return {
                current: null
            }
        },
        mounted() {
            this.$nextTick(function () {
                bus.$on('inject-component', this.dispatchInstance)
                bus.$on('get-current-user', this.getCurrentUser)
                bus.$on('get-route-for-key', this.getRouteForKey)
            })
        },
        computed: {
            switchInstance() {
                if (this.currentUser.role === "ROLE_ADMIN") {
                    return this.current === User ? User : Schedule
                } else {
                    return this.current = Schedule
                }
            }
        },
        components: {User, Schedule},
        props: {
            router: {
                type: Object
            },
            currentUser: {
                type: Object
            }
        },
        methods: {
            dispatchInstance: function (instance) {
                this.current = this.current === instance ? null : instance
            },
            getCurrentUser(cb) {
                if (typeof cb === 'function') {
                    cb(this.currentUser)
                }
            }
        }
    }

</script>
