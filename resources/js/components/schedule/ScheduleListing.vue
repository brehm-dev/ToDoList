<template>
    <div class="card mb-3 bg-secondary" v-if="schedules !== false">
        <div class="card-header">{{ type.name }} Schedules</div>
        <div class="card-body">
            <ul class="list-group">
                <li class="list-group-item mb-1" v-for="(schedule, index) in schedules" ref="schedule">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="row">
                                <span class="badge badge-light">Name: </span>
                                <span class="badge badge-light">{{ schedule.name }}</span>
                                <span class="badge badge-light">Id: </span>
                                <span class="badge badge-light">{{ schedule.id }}</span>
                            </div>
                            <div class="row">
                                <span class="badge badge-light">Type: </span>
                                <span class="badge badge-light">{{ schedule.type }}</span>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="row">
                                <span class="badge badge-light">Owner: </span>
                                <span class="badge badge-light">{{ schedule.owner.username || schedule.owner.email }}</span>
                            </div>
                            <div class="row">
                                <span class="badge badge-light">ToDos: </span>
                                <span class="badge badge-light">{{ schedule.todos }}</span>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <button
                                @click="enterSchedule(schedule)"
                                class="btn btn-info"
                            >Enter</button>
                            <button
                                @click="deleteSchedule(schedule, index)"
                                class="btn btn-danger"
                            >Delete</button>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
    <div class="card mb-3 bg-danger" v-else>
        <div class="card-body">
            <p class="lead">{{ type.empty }}</p>
        </div>
    </div>
</template>

<script>
    import {bus} from '../../app'

    export default {
        data: function () {
            return {
                user: {},
            }
        },
        props: {
            schedules: {
                type: [Object, Boolean, Array]
            },
            type: {
                type: Object
            },
            router: {
                type: Object
            }
        },
        created() {
            bus.$emit('get-current-user', (user) => {
                this.user = user
            })

        },
        methods: {
            deleteSchedule(schedule, index) {
                console.log(this.router)
                // if (window.confirm(`Do you want to delete Schedule: ${schedule.name} ?`)) {
                //     const deleteRoute = this.router.schedule['delete']
                //     const route = deleteRoute.action.replace('{schedule}', schedule.id)

                    // window.axios({
                    //     method: deleteRoute.method,
                    //     url: route
                    // }).then(response => {
                    //     if (response.data.deleted) this.$refs['schedule'][index].remove()
                    // })
                // }
            },
            enterSchedule(schedule) {
                bus.$emit('redirect-schedule', {
                    route: 'ProcedureIndex',
                    schedule: schedule
                })
            }
        }
    }
</script>
