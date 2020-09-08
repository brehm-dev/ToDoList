<template>
    <div class="form-group">
        <div class="row mb-3">
            <textarea class="form-control" v-model="procedure.content"></textarea>
        </div>
    </div>
</template>

<script>
    export default {
        data: function () {
            return {
                procedure: {
                    content_type: 'todo'
                }
            }
        },
        methods: {
            submit() {
                this.$parent.create({
                    axios: {
                        method: 'POST',
                        url: this.$route.fullPath.substring(0, this.$route.fullPath.length - 1),
                        data: this.procedure
                    },
                    callback: (response) => {
                        if (response.status === 201) {
                            this.$router.push({
                                name: 'ProcedureIndex',
                                params: {
                                    sid: this.$route.params.sid,
                                    schedule: this.$route.params.schedule
                                }
                            }).catch(e => {
                                // console.log(e)
                            })
                        }
                    }
                })
            }
        },
        beforeMount() {
            this.$parent.setComponent({
                current: this.$route.name,
                title: this.$route.name,
                form: true
            })
            window.EventBus.$on(this.$route.name, this.submit)
        },
        beforeDestroy() {
            window.EventBus.$off(this.$route.name, this.submit)
        }
    }
</script>
