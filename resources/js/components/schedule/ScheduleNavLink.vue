<template>
    <li class="nav-item">
        <a @click.prevent="injectComponent" v-bind:href="scheduleIndexRoute"  class="nav-link">Schedules</a>
    </li>
</template>

<script>
    import Schedule from "../Schedule";
    export default {
        name: 'ScheduleNavLink',
        data: function () {
            return {
            }
        },
        methods: {
            injectComponent: function () {
                window.EventBus.$emit('inject-component', Schedule)
            }
        },
        props: ['scheduleIndexRoute']
    }
</script>
