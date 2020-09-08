<template>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="row">
                            <h5>User {{ setting.action }}</h5>
                        </div>
                    </div>
                    <div class="col-sm-4"></div>
                    <div class="col-sm-4">
                        <router-link
                            tag="button"
                            class="btn btn-sm btn-primary"
                            :to="{ name: 'UserCreate' }"
                        >Create New User</router-link>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <router-view></router-view>
            </div>
            <div class="card-footer" v-if="setting.form">
                <div class="row">
                    <button type="submit" class="btn btn-block btn-success" @click="submit">Submit</button>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
    const Axios = require('./lib/axios-custom').default
    export default {
        data: function () {
            return {
                setting: {
                    current: 'UserIndex',
                    form: false,
                }
            }
        },
        methods: {
            submit() {
                window.EventBus.$emit(this.setting.current);
            },
            setComponent(options = {}) {
                if (options.hasOwnProperty('current')) this.setting.current = options.current
                if (options.hasOwnProperty('form')) this.setting.form = options.form;
            },
            async editUser(options) {
                return await Axios({
                    method: 'PATCH',
                    url: options.url,
                    data: options.data
                }).then(response => {
                    return response.data
                }).catch(error => {
                    // console.error(error)
                });
            },
            async createUser(url, credentials) {
                return await Axios({
                    method:'POST',
                    url: url,
                    data: credentials
                }).then(response => {
                     return response.data
                }).catch(error => {
                    console.log(error)
                })
            },
            async indexUsers() {
                return await Axios({
                    method: 'GET',
                    url: '/user'
                }).then(response => {
                    return response.data
                })
            },
            async delete(url) {
                return await Axios({
                    method: 'DELETE',
                    url: url
                }).then(response => {
                    if (response.data.deleted) {
                        this.$router.push({ name: 'UserIndex' })
                    }
                }).catch(e => {
                    console.error(e)
                    this.$router.push({ name: 'UserIndex' })
                })
            }
        }
    }
</script>
