<template>
    <ul class="list-group">
        <li v-for="user in users" class="list-group-item">
            <div class="row">
                <div class="col-sm-3">
                    <span class="badge badge-light">ID: </span>
                    <span class="badge badge-light">{{ user.id }}</span>
                </div>
                <div class="col-sm-3">
                    <span class="badge badge-light">Email: </span>
                    <span class="badge badge-light">{{ user.email }}</span>
                </div>
                <div class="col-sm-3">
                    <span class="badge badge-light">Role: </span>
                    <span class="badge badge-light">{{ user.role }}</span>
                </div>
                <div class="col-sm-3">
                    <button
                        class="btn btn-info"
                        @click="editUser(user)"
                    >Edit</button>
                    <button
                        class="btn btn-danger"
                        @click="deleteUser(user)"
                    >Delete</button>
                </div>
            </div>
        </li>
    </ul>
</template>

<script>
    import { bus } from '../../app'

    export default {
        name: 'UserIndex',
        data: function () {
            return {
                users: null,
            }
        },
        props: {
            route: {
                type: Object
            }
        },
        methods: {
            editUser(user) {
                bus.$emit('redirect-component', {route: 'Edit', user: user})
            },
            deleteUser(user) {
                bus.$emit('delete-user', {route: 'Delete', user: user})
            }
        },
        created() {
            if (this.users === null) {
                window.axios({
                    method: this.route.method,
                    url: this.route.action
                }).then(response => {
                    this.users = response.data
                })
            }
        }
    }
</script>
