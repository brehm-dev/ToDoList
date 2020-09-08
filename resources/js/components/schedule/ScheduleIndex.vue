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
    import ScheduleListing from './ScheduleListing'

    export default {
        name: 'ScheduleIndex',
        data: function () {
            return {
                schedules: {},
            }
        },
        beforeMount() {
            const schedules = this.$parent.index(schedules => {
                this.schedules = schedules
            })
        },
        components: {ScheduleListing},
        methods: {}
    }
</script>
