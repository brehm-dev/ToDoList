<template>
    <component
        :is="current"
        v-bind="switchInstance"
    ></component>
</template>

<script>
    import User from './User';
    import Schedule from './Schedule';
    import { bus } from '../app'

    export default {
        name: 'instance-loader',
        data: function () {
            return {
                current: null
            }
        },
        mounted() {
            this.$nextTick(function () {
                bus.$on('inject-component', this.dispatchInstance);
            })
        },
        computed: {
            switchInstance() {
                if (this.userIsAdmin === false) {
                    return this.current === User ? User : Schedule
                } else {
                    return this.current = Schedule
                }
            }
        },
        components: {
            User: User,
            Schedule: Schedule
        },
        props: {
            userIsAdmin: {
                type: Boolean
            },
            routes: {
                type: Object
            }
        },
        methods: {
            dispatchInstance: function (instance) {
                instance.routes = this.routes.user
                this.current = instance
            }
        }
    }

</script>
