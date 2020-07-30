<template>
    <div class="container">
        <div class="card bg-dark text-white">
            <div class="card-header">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="row">
                            <h5>Schedule {{ route }}</h5>
                        </div>
                        <div class="row">
                            <button
                                @mouseup="returnToPrevious"
                                class="btn btn-sm btn-outline-light"
                                v-show="this.route !== 'Index'"
                            >
                                <h5>&lt;</h5>
                            </button>
                        </div>
                    </div>
                    <div class="col-sm-4"></div>
                    <div class="col-sm-4">
                        <button v-show="route === 'Index'" class="btn btn-sm btn-primary" @click="switchRoute({route: 'Create'})">Create New Schedule</button>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <ScheduleIndex
                    v-if="route === 'Index'"
                    v-bind:router="router"
                ></ScheduleIndex>
                <ScheduleCreate
                    v-if="route === 'Create'"
                    v-bind:router="router"
                ></ScheduleCreate>
                <ProcedureIndex
                    v-if="route === 'ProcedureIndex'"
                    v-bind:router="router"
                    v-bind:schedule="schedule"
                ></ProcedureIndex>
                <ProcedureCreate
                    v-if="route === 'ProcedureCreate'"
                    v-bind:router="router"
                    v-bind:schedule="schedule"
                ></ProcedureCreate>
            </div>
            <div class="card-footer" v-if="route === 'Create' || route === 'Edit' || route === 'ProcedureCreate'">
                <div class="row">
                    <button type="submit" class="btn btn-block btn-success" @click="submitSchedule()">Submit</button>
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

    import { bus } from '../app'

    export default {
        name: 'Schedule',
        data: function () {
            return {
                route: 'Index',
                schedule: {},
                history: [],
            }
        },
        mounted() {

            this.$nextTick(() => {
                bus.$on('redirect-schedule', this.switchRoute)
            })
        },
        methods: {
            getRouteForKey(key) {
                if (this.routes.hasOwnProperty(key)) return this.routes[key]
                return false
            },
            submitSchedule() {
                const submitSchedule = 'submit-schedule'
                const submitProcedure = 'submit-procedure'

                if (this.route === ('Create' || 'Edit')) {
                    bus.$emit(submitSchedule)
                } else {
                    bus.$emit(submitProcedure)
                }
            },
            switchRoute(args) {

                this.history.push(this.route)
                if (args.hasOwnProperty('schedule')) this.schedule = args.schedule
                if (args.hasOwnProperty('route')) this.route = args.route
            },
            returnToPrevious() {
                const index = 'Index'
                const procedureIndex = 'ProcedureIndex'
                const procedureCreate = 'ProcedureCreate'
                console.log(this.history)
                const last = this.history[this.history.length - 1]
                const priv = this.history[this.history.length - 2]
                if (
                    priv === procedureIndex && last === procedureCreate ||
                    priv === procedureCreate && last === procedureIndex ||
                    priv === procedureIndex && last === procedureIndex ||
                    last === procedureIndex && priv === index ||
                    last === index
                ) {
                    this.route = index
                }
                if (
                    priv === index && last === procedureIndex ||
                    priv === procedureIndex && last === procedureIndex
                ) {
                    this.route = procedureIndex
                }

            }
        },
        components: {ScheduleIndex, ScheduleCreate, ProcedureIndex, ProcedureCreate},
        props: {
            router: {
                type: Object
            }
        }
    }
</script>
