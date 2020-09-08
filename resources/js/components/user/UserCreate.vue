<template>
    <div class="form-group">
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
            <label for="password" class="col-md-4 col-form-label text-md-right">Password:</label>
            <div class="col-md-6">
                <input id="password" type="password" class="form-control" name="password" v-model="credentials.password">
            </div>
        </div>
        <div class="row mb-3">
            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Password-Confirm</label>
            <div class="col-md-6">
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" v-model="credentials.password_confirmation">
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
    export default {
        name: 'UserCreate',
        data: function () {
            return {
                credentials: {
                    username: null,
                    email: null,
                    password: null,
                    password_confirmation: null,
                    role: null
                },
            }
        },
        methods: {
            submit() {
                this.$parent.createUser(
                    this.$route.fullPath.substring(0, this.$route.fullPath.length - 1),
                    this.credentials
                ).then(response => {
                    if (response.hasOwnProperty('id')) {
                        this.$router.push({
                            name: 'UserIndex'
                        }).catch(error => {
                            // TODO: Error-Handling
                        })
                    }
                })
            }
        },
        beforeMount() {
            window.EventBus.$on('UserCreate', this.submit);
        },
        mounted() {
            this.$parent.setComponent({
                current: 'UserCreate',
                form: true
            })
        },
        beforeDestroy() {
            window.EventBus.$off('UserCreate', this.submit);
        }
    }
</script>
