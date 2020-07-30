<template>
    <div class="form-group">
        <div class="row mb-3">
            <label for="username" class="col-sm-4 col-form-label text-md-right">ID:</label>
            <div class="col-sm-6">
                <input name="username" type="text" class="form-control" v-model="credentials.id" disabled>
            </div>
        </div>
        <div class="row mb-3">
            <label for="username" class="col-sm-4 col-form-label text-md-right">Username:</label>
            <div class="col-sm-6">
                <input name="username" type="text" class="form-control" v-model="credentials.username" required>
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-4 col-form-label text-md-right" for="email">Email:</label>
            <div class="col-sm-6">
                <input name="email" type="text" class="form-control" required v-model="credentials.email">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-4 col-form-label text-md-right" >Email verified?:</label>
            <div class="col-sm-6">
                <input type="checkbox" class="form-control" v-model="credentials.email_verified_at">
            </div>
        </div>
        <div class="row mb-3">
            <label for="password" class="col-md-4 col-form-label text-md-right">Created_At:</label>
            <div class="col-md-6">
                <input type="text" class="form-control" v-model="credentials.created_at" disabled>
            </div>
        </div>
        <div class="row mb-3">
            <label for="password" class="col-md-4 col-form-label text-md-right">Updated_At:</label>
            <div class="col-md-6">
                <input type="text" class="form-control" v-model="credentials.updated_at" disabled>
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-4 col-form-label text-md-right">Role:</label>
            <div class="col-sm-6">
                <select class="custom-select" name="role" id="role" v-model="credentials.role">
                    <option value="ROLE_USER">USER</option>
                    <option value="ROLE_ADMIN">ADMIN</option>
                </select>
            </div>
        </div>
    </div>
</template>

<script>
    import { bus } from '../../app'

    export default {
        name: 'UserEdit',
        data: function () {
            return {
                errors: []
            }
        },
        props: {
            router: {
                type: Object
            },
            credentials: {
                type: Object
            }
        },
        methods: {
            submit() {
                const url = this.router.user.update.action.replace('{user}', this.credentials.id)
                // console.log(this.route, url, this.credentials)
                window.axios({
                    method: this.router.user.update.method,
                    url: url,
                    data: {
                        username: this.credentials.username,
                        email: this.credentials.email,
                        role: this.credentials.role
                    }
                }).then(response => {
                    bus.$emit('redirect-component', {route: 'Index'})
                    console.log(response)
                }).catch(e => {
                    this.errors.push(e)
                    console.log(this.errors)
                })
            }
        },
        mounted() {
            this.$nextTick(function () {
                bus.$on('submit-user', this.submit);
            })
        },
    }
</script>
