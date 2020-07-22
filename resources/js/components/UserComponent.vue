<template>

    <div class="container" v-if="data.method  == 'POST'">
        <div class="form-control-sm">
            <ul class="list-group">
                <li class="list-group-item">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Username:</span>
                        </div>
                        <input type="text" class="form-control" v-model="username">
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="input.email">Email:</span>
                        </div>
                        <input type="text" class="form-control" aria-describedby="basic-addon3" v-model="email">
                    </div>
                </li>
                <li class="list-group-item"></li>
                <li class="list-group-item"></li>
            </ul>
        </div>
    </div>
    <form @submit.prevent="formSubmit" ref="form" v-else>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Create User</div>
                        <div class="card-body">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="">First and last name</span>
                                </div>
                                <input type="text" class="form-control" v-model="firstname">
                                <input type="text" class="form-control" v-model="lastname">
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon3">Email:</span>
                                </div>
                                <input type="text" class="form-control" id="email" aria-describedby="basic-addon3" v-model="email">
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon4">Password:</span>
                                </div>
                                <input type="password" class="form-control" id="password" aria-describedby="basic-addon3" v-model="password">
                            </div>
                            <div class="form-check">
                                <input type="radio" id="role_admin" class="form-check-input" value="ADMIN" v-model="role">
                                <label for="role_admin" class="form-check-label">ADMIN</label>
                            </div>
                            <div class="form-check">
                                <input type="radio" id="role_master" class="form-check-input" value="MASTER" v-model="role">
                                <label for="role_master" class="form-check-label">MASTER</label>
                            </div>
                            <div class="form-check">
                                <input type="radio" id="role_user" class="form-check-input" value="USER" v-model="role" checked="checked">
                                <label for="role_user" class="form-check-label">USER</label>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <pre>{{ output }}</pre>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</template>

<script>
    export default {
        mounted() {
            this.status
            if (this.methods === undefined) {
                this.methods = {
                    GET: 'GET',
                    POST: 'POST',
                    PATCH: 'PATCH',
                    DELETE: 'DELETE'
                }
            }
        },
        data() {
            return {
                firstname: '',
                lastname: '',
                email: '',
                password: '',
                role: '',
                output: ''
            }
        },
        props: ['data'],
        methods: {
            formSubmit(e) {
                e.preventDefault()
                window.axios({
                    method: this.data.method,
                    url: this.data.url,
                    data: {
                        first_name: this.firstname,
                        last_name: this.lastname,
                        email: this.email,
                        password: this.password,
                        role: this.role
                    }
                }).then((response) => {
                    this.output = response
                })
                // console.log()
            }
        }
    }
</script>
