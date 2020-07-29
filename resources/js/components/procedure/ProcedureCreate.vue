<template>
    <div class="form-group">
        <div class="row mb-3">
            <textarea class="form-control" v-model="procedure.content"></textarea>
        </div>
<!--        <div class="row mb-3">-->
<!--            <label class="col-sm-4 col-form-label text-md-right">State:</label>-->
<!--            <div class="col-sm-6">-->
<!--                <select class="custom-select" name="state" id="state" v-model="schedule.state">-->
<!--                    <option value="active">private</option>-->
<!--                    <option value="global">global</option>-->
<!--                </select>-->
<!--            </div>-->
<!--        </div>-->
    </div>
</template>

<script>
    import { bus } from '../../app'

    export default {
        name: 'ProcedureCreate',
        data: function () {
            return {
                procedure: {
                    content_type: 'todo'
                }
            }
        },
        props: {
            route: {
                type: Object
            },
            schedule: {
                type: Object
            }
        },
        methods: {
            submit() {
                window.axios({
                    method: this.route.method,
                    url: this.route.action.replace('{schedule}', this.schedule.id),
                    data: this.procedure
                }).then(response => {
                    console.log(response)
                    bus.$emit('redirect-schedule', {route: 'ProcedureIndex', schedule: this.schedule})
                }).catch(e => {
                    console.log(e)
                })
            }
        },
        mounted() {
            this.$nextTick(function () {
                bus.$on('submit-procedure', this.submit);
            })
        }
    }
</script>
