<template>
    <div class="container">
        <div class="card bg-dark text-white">
            <div class="card-header">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="row">
                            <h5>Schedule {{ setting.title }}</h5>
                        </div>
                    </div>
                    <div class="col-sm-4"></div>
                    <div class="col-sm-4">
                        <router-link
                            :to="{ name: 'ScheduleCreate' }"
                            class="btn btn-sm btn-primary"
                        >Create New Schedule</router-link>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <router-view></router-view>
            </div>
            <div class="card-footer" v-if="setting.form">
                <div class="row">
                    <button type="submit" class="btn btn-block btn-success" @click="submit()">Submit</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import ScheduleIndex from './schedule/ScheduleIndex'
    import ScheduleCreate from './schedule/ScheduleCreate'
    import ProcedureIndex from './procedure/ProcedureIndex'
    import ProcedureCreate from './procedure/ProcedureCreate'

    const Axios = require('./lib/axios-custom').default

    export default {
        name: 'Schedule',
        data: function () {
            return {
                setting: {
                    current: 'ScheduleIndex',
                    title: null,
                    form: false
                }
            }
        },
        mounted() {

            // this.$nextTick(() => {
            //     window.EventBus.$on('redirect-schedule', this.switchRoute)
            // })
        },
        methods: {
            setComponent(options) {
                if (options.hasOwnProperty('current')) {
                    this.setting.current = options.current
                }
                if (options.hasOwnProperty('form')) {
                    if (options.form === true) {
                        this.setting.form = options.form
                    }
                }
                if (options.hasOwnProperty('title')) {
                    this.setting.title = options.title
                }
            },
            submit() {
               window.EventBus.$emit(this.$route.name)
            },
            index(callback) {
                return Axios({
                    method: 'GET',
                    url: this.$route.fullPath
                }).then(response => {
                    callback(response.data)
                }).catch(e => {
                    console.log(e)
                })
            },
            create(options) {
                Axios(options.axios).then(response => {
                    options.callback(response)
                })
            }
        }
    }
</script>
