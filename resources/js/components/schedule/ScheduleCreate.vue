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

    export default {
        name: 'ScheduleCreate',
        data: function () {
            return {
                schedule: {
                    name: null,
                    type: null
                }
            }
        },
        mounted() {
            this.$nextTick(function () {
                bus.$on('submit-schedule', this.submit);
            })
        },
        props: {
            router: {
                type: Object
            }
        },
        methods: {
            submit() {
                window.axios({
                    method: this.router.schedule.create.method,
                    url: this.router.schedule.create.action,
                    data: this.schedule
                }).then(response => {
                    // console.log(response)
                    bus.$emit('redirect-schedule', {route: 'Index'})
                }).catch(e => {
                    console.log(e)
                })
            }
        }
    }
</script>
