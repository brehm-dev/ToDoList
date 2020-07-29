<template>
    <li class="nav-item">
        <a @click.prevent="injectComponent" v-bind:href="scheduleIndexRoute"  class="nav-link">Schedules</a>
    </li>
</template>

<script>
    import { bus } from "../../app";
    import Schedule from "../Schedule";


    export default {
        name: 'ScheduleNavLink',
        data: function () {
            return {
            }
        },
        methods: {
            injectComponent: function () {
                bus.$emit('inject-component', Schedule)
            }
        },
        props: ['scheduleIndexRoute']
    }
</script>
