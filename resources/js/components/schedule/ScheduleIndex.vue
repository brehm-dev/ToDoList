<template>
    <div class="container">
        <ScheduleListing
            v-bind:schedules="schedules.privates"
            v-bind:type="{
            name: 'Private',
            empty: 'You have no private Schedules yet.'
        }"
        ></ScheduleListing>
        <ScheduleListing
            v-bind:schedules="schedules.ownGlobals"
            v-bind:type="{
            name: 'Own Global',
            empty: 'You have no global Schedules yet.'
        }"
        ></ScheduleListing>
        <ScheduleListing
            v-bind:schedules="schedules.foreignGlobals"
            v-bind:type="{
            name: 'Foreign Global',
            empty: 'There are no foreign global Schedules yet.'
        }"
        ></ScheduleListing>
    </div>
</template>

<script>
    import { bus } from '../../app'
    import ScheduleListing from './ScheduleListing'

    export default {
        name: 'ScheduleIndex',
        data: function () {
            return {
                schedules: {}
            }
        },
        props: {
            route: {
                type: Object
            }
        },
        methods: {
            // editUser(user) {
            //     bus.$emit('redirect-component', {route: 'Edit', user: user})
            // },
            // deleteUser(user) {
            //     bus.$emit('delete-user', {route: 'Delete', user: user})
            // }
        },
        created() {
            window.axios({
                method: this.route.method,
                url: this.route.action
            }).then(response => {
                console.log(response.data)
                this.schedules = response.data
            })
        },
        components: {ScheduleListing}
    }
</script>
