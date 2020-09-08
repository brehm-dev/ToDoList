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
                    <router-link class="btn btn-info" tag="button"
                        :to="{ name: 'UserEdit', params: { id: user.id, user: user } }"
                    >Edit</router-link>
                    <router-link
                        class="btn btn-danger"
                        :to="{ name: 'UserDelete', params: { id: user.id, user: user } }"
                    >Delete</router-link>
                </div>
            </div>
        </li>
    </ul>
</template>

<script>

    export default {
        name: 'UserIndex',
        data: function () {
            return {
                users: null,
            }
        },
        methods: {},
        beforeMount() {
            this.$parent.setComponent({
                current: 'UserIndex',
                form: false
            })
        },
        mounted() {
            const asyncUsers = this.$parent.indexUsers()
            const bindUsers = (users) => {
                this.users = users
            }
            asyncUsers.then(res => {
                bindUsers(res)
            })
        }
    }
</script>
