<template>
    <div class="form-group">
        <div class="row mb-3">
            <label class="col-sm-4 col-form-label text-md-right">Schedule Name:</label>
            <div class="col-sm-6">
                <input name="schedule-name" type="text" class="form-control" v-model="schedule.name" required>
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-4 col-form-label text-md-right">Type:</label>
            <div class="col-sm-6">
                <select class="custom-select" name="role" id="role" v-model="schedule.type">
                    <option value="private">private</option>
                    <option value="global">global</option>
                </select>
            </div>
        </div>
    </div>
</template>

<script>
    import { bus } from '../../app'

    import { Axios } from 'axios'

    export default {
        data: function () {
            return {
                schedule: {
                    name: null,
                    type: null
                }
            }
        },
        beforeMount() {
            this.$parent.setComponent({
                current: 'ScheduleCreate',
                form: true,
                title: 'Create a Schedule'
            })
            window.EventBus.$on(this.$route.name, this.submit)
        },
        beforeDestroy() {
            window.EventBus.$off(this.$route.name, this.submit)
        },
        methods: {
            submit() {
                this.$parent.create({
                    axios: {
                        method: 'POST',
                        url: this.$route.fullPath.substring(0, this.$route.fullPath.length - 1),
                        data: this.schedule
                    },
                    callback: (response) => {
                        if (response.data.hasOwnProperty('id')) {
                            this.$router.push({
                                name: 'ProcedureIndex',
                                params:
                                    {
                                        id: response.data.id,
                                        schedule: response.data
                                    }
                            })
                        }
                    }
                })
            }
        }
    }
</script>
