

<template>
    <form @submit.prevent="formSubmit" action="">
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
                                    <span class="input-group-text" id="basic-addon4">Email:</span>
                                </div>
                                <input type="password" class="form-control" id="password" aria-describedby="basic-addon3" v-model="password">
                            </div>
                            <div class="input-group">
                                <div class="input-group-text">
                                    <label for="role_admin">ADMIN</label>
                                    <input type="radio" id="role_admin" name="role" v-model="role">
                                </div>
                                <div class="input-group-text">
                                    <label for="role_admin">MASTER</label>
                                    <input type="radio" id="role_master" name="role" v-model="role">
                                </div>
                                <div class="input-group-text">
                                    <label for="role_admin">USER</label>
                                    <input type="radio" id="role_user" name="role" v-model="role" checked="checked">
                                </div>
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
            console.log(window)
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
                        firstname: this.firstname,
                        lastname: this.lastname,
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
