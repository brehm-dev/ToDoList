<template>
    <component
        :is="current"
        v-bind="switchInstance"
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
                bus.$on('get-routes-for-component', this.getRoutesForComponent)
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
            allRoutes: {
                type: Object
            },
            currentUser: {
                type: Object
            }
        },
        methods: {
            dispatchInstance: function (instance) {
                instance.routes = this.allRoutes
                this.current = instance
            },
            getRoutesForComponent(component, callback) {
                let routes = {}
                if (component.length < 1) {
                    routes = this.allRoutes
                } else {
                    if (this.allRoutes.hasOwnProperty(component)) {
                        routes = this.allRoutes[component]
                    }
                }
                if (typeof callback === 'function') {
                    callback(routes)
                }
            },
            getCurrentUser(cb) {
                if (typeof cb === 'function') {
                    cb(this.currentUser)
                }
            }
        }
    }

</script>
