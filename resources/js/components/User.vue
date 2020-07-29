<template>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-sm-4"><h5>User {{ route }}</h5></div>
                    <div class="col-sm-4"></div>
                    <div class="col-sm-4">
                        <button class="btn btn-primary" @click="switchType({route: 'Create'})">Create New User</button>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <UserIndex
                    v-if="route === 'Index'"
                    v-bind:route="routes.index"
                ></UserIndex>

                <UserCreate
                    v-if="route === 'Create'"
                    v-bind:route="routes.create"
                ></UserCreate>

                <UserEdit
                    v-if="route === 'Edit'"
                    v-bind:route="routes.update"
                    v-bind:credentials="user"
                ></UserEdit>

                <UserDelete
                    v-if="route === 'Delete'"
                    v-bind:route="routes.delete"
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
                user: null
            }
        },
        mounted() {
            this.$nextTick(() => {
                bus.$on('redirect-component', this.switchType)
                bus.$on('delete-user', this.deleteUser)
            })
        },
        methods: {
            deleteUser(args) {
                this.user = args.user
                this.route = args.route
            },
            switchType(args) {
                if (args.hasOwnProperty('user')) this.user = args.user
                if (args.hasOwnProperty('route')) this.route = args.route
            },
            submitUser(event) {
                bus.$emit('submit-user');
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
