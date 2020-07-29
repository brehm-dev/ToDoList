<template>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="row">
                            <h5>User {{ route }}</h5>
                        </div>
                        <div class="row">
                            <button
                                @mouseup="returnToPrevious"
                                class="btn btn-sm btn-outline-dark"
                                v-show="this.route !== 'Index'"
                            >
                                <h5>&lt;</h5>
                            </button>
                        </div>
                    </div>
                    <div class="col-sm-4"></div>
                    <div class="col-sm-4">
                        <button class="btn btn-primary" @click="switchRoute({route: 'Create'})">Create New User</button>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <UserIndex
                    v-if="route === 'Index'"
                    v-bind:route="routes.user.index"
                ></UserIndex>

                <UserCreate
                    v-if="route === 'Create'"
                    v-bind:route="routes.user.create"
                ></UserCreate>

                <UserEdit
                    v-if="route === 'Edit'"
                    v-bind:route="routes.user.update"
                    v-bind:credentials="user"
                ></UserEdit>

                <UserDelete
                    v-if="route === 'Delete'"
                    v-bind:route="routes.user.delete"
                    v-bind:user="user"
                ></UserDelete>
            </div>
            <div class="card-footer" v-if="route === 'Create' || route === 'Edit'">
                <div class="row">
                    <button type="submit" class="btn btn-block btn-success" @click="submitUser">Submit</button>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
    import UserIndex from "./user/UserIndex";
    import UserCreate from "./user/UserCreate";
    import UserEdit from "./user/UserEdit";
    import UserDelete from "./user/UserDelete"
    import { bus } from "../app";

    export default {
        name: 'User',
        data: function () {
            return {
                route: 'Index',
                user: null,
                history: []
            }
        },
        mounted() {
            this.$nextTick(() => {
                bus.$on('redirect-component', this.switchRoute)
                bus.$on('delete-user', this.deleteUser)
                bus.$on('return-to-previous', () => {
                    console.log(this.history[this.history.length - 1])
                    this.route = this.history[this.history.length - 1]
                })
            })
        },
        methods: {
            deleteUser(args) {
                this.user = args.user
                this.route = args.route
            },
            switchRoute(args) {
                this.history.push(this.route)
                if (args.hasOwnProperty('user')) this.user = args.user
                if (args.hasOwnProperty('route')) this.route = args.route
            },
            submitUser(event) {
                bus.$emit('submit-user');
            },
            returnToPrevious() {
                bus.$emit('return-to-previous')
            }
        },
        components: {UserIndex, UserCreate, UserEdit, UserDelete},
        props: {
            routes: {
                type: Object
            }
        }
    }
</script>
