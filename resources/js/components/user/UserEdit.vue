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

export default {
    name: 'UserEdit',
    data: function () {
        return {
            errors: [],
            credentials: {}
        }
    },
    methods: {
        submit() {
            this.$parent.editUser({
                url: this.$route.fullPath,
                data: {
                    username: this.credentials.username,
                    email: this.credentials.email,
                    role: this.credentials.role,
                }
            }).then(user => {
                console.log('Edited User', user)
                if (user.hasOwnProperty('id')) {
                    this.$router.push({
                        name: 'UserIndex'
                    }).catch((error) => {
                        console.log(error)
                    })
                }
            })
        }
    },
    beforeMount() {
        this.$parent.setComponent({
            current: 'UserEdit',
            form: true
        })
        if (this.$route.params.hasOwnProperty('user')) {
            this.credentials = this.$route.params.user
        } else {
            this.credentials = {}
        }
        window.EventBus.$on('UserEdit', this.submit);
    },
    beforeDestroy() {
        window.EventBus.$off('UserEdit', this.submit);
    }
}
</script>
