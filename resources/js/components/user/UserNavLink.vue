<template>
    <li class="nav-item">
        <a v-bind:href="userIndexRoute" class="nav-link" @click.prevent="injectComponent">Users</a>
    </li>
</template>

<script>
    import { bus } from "../../app";
    import User from '../User'

    export default {
        name: 'user-nav-link',
        mounted() {
            // console.log(this)
        },
        methods: {
            injectComponent: function () {
                bus.$emit('inject-component', User)
            }
        },
        props: {
            userIndexRoute: {
                type: String,
                required: true
            }
        }
    }
</script>
