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
                schedules: {},
            }
        },
        mounted() {},
        created() {
            window.axios({
                method: this.router.schedule.index.method,
                url: this.router.schedule.index.action
            }).then(response => {
                console.log(response.data)
                this.schedules = response.data
            })
        },
        props: {
            router: {
                type: Object
            }
        },
        components: {ScheduleListing},
        methods: {
            // editUser(user) {
            //     bus.$emit('redirect-component', {route: 'Edit', user: user})
            // },
            // deleteUser(user) {
            //     bus.$emit('delete-user', {route: 'Delete', user: user})
            // }
        }
    }
</script>
