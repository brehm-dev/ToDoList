<template>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-sm-4">
                        <span class="badge badge-light">{{ schedule.name }}</span>
                    </div>
                    <div class="col-sm-4">Search</div>
                    <div class="col-sm-4">
                        <router-link
                            :to="{ name: 'ProcedureCreate', params: { sid: schedule.id, schedule: schedule } }"
                            class="btn btn-success"
                        >Create ToDo</router-link>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <ul class="list-group">
                    <li class="list-group-item mb-1" v-show="mode === 'new'" ref="new-procedure">
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="row">
                                    <span class="badge badge-light">State: </span>
                                    <span class="badge badge-light">{{ newProcedure.state }}</span>
                                </div>
                                <div class="row">
                                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                        <label
                                            @mouseup="setProcedureState(newProcedure, 'active')"
                                            class="btn btn-sm btn-light"
                                            v-bind:class="{ 'btn-dark': newProcedure.state === 'active' }"
                                        >
                                            <input type="radio" value="active" v-model="newProcedure.state"> Activate
                                        </label>
                                        <label
                                            @mouseup="setProcedureState(newProcedure, 'pause')"
                                            class="btn btn-sm btn-light"
                                            v-bind:class="{ 'btn-dark': newProcedure.state === 'pause' }"
                                        >
                                            <input type="radio" value="pause" v-model="newProcedure.state"> Pause
                                        </label>
                                        <label
                                            @mouseup="setProcedureState(newProcedure, 'finish')"
                                            class="btn btn-sm btn-light"
                                            v-bind:class="{ 'btn-dark': newProcedure.state === 'finish' }"
                                        >
                                            <input type="radio" value="finish" v-model="newProcedure.state"> Finish
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6" ref="edit-procedure-content">
                                <textarea name="content" rows="1" class="form-control"
                                          v-model="newProcedure.content" style="resize: none"
                                ></textarea>
                            </div>
                            <div class="col-sm-3">
                                <div class="row pull-right">
<!--                                    <button-->
<!--                                        @mouseup="editContent(procedure, index, $event)"-->
<!--                                        class="btn btn-sm btn-outline-secondary mr-2"-->
<!--                                    >Edit</button>-->
<!--                                    <button-->
<!--                                        @mouseup="deleteProcedure(procedure, index)"-->
<!--                                        class="btn btn-sm btn-outline-danger"-->
<!--                                    >Delete</button>-->
                                </div>

                            </div>
                        </div>
                    </li>
                    <li class="list-group-item mb-1" v-for="(procedure, index) in procedures" ref="procedure">
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="row">
                                    <span class="badge badge-light">State: </span>
                                    <span class="badge badge-light">{{ procedure.state }}</span>
                                    <span class="badge badge-light">{{ procedure.creator.username || procedure.creator.email }}</span>
                                </div>
                                <div class="row">
                                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                        <label
                                            @mouseup="setProcedureState(procedure, 'active')"
                                            class="btn btn-sm btn-light"
                                            v-bind:class="{ 'btn-dark': procedure.state === 'active' }"
                                        >
                                            <input type="radio" value="active" v-model="procedure.state"> Activate
                                        </label>
                                        <label
                                            @mouseup="setProcedureState(procedure, 'pause')"
                                            class="btn btn-sm btn-light"
                                            v-bind:class="{ 'btn-dark': procedure.state === 'pause' }"
                                        >
                                            <input type="radio" value="pause" v-model="procedure.state"> Pause
                                        </label>
                                        <label
                                            @mouseup="setProcedureState(procedure, 'finish')"
                                            class="btn btn-sm btn-light"
                                            v-bind:class="{ 'btn-dark': procedure.state === 'finish' }"
                                        >
                                            <input type="radio" value="finish" v-model="procedure.state"> Finish
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6" ref="edit-procedure-content">
                                <textarea name="content" rows="1" class="form-control"
                                    v-model="procedure.content" disabled style="resize: none"
                                ></textarea>
                            </div>
                            <div class="col-sm-3">
                                <div class="row pull-right">
                                    <button
                                        @mouseup="editContent(procedure, index, $event)"
                                        class="btn btn-sm btn-outline-secondary mr-2"
                                    >Edit</button>
                                    <button
                                        @mouseup="deleteProcedure(procedure, index)"
                                        class="btn btn-sm btn-outline-danger"
                                    >Delete</button>
                                </div>

                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data: function () {
            return {
                procedures: {},
                mode: 'view',
                newProcedure: {},
                schedule: {}
            }
        },
        methods: {
            createProcedure(schedule) {
                // this.mode = 'new'
                // window.EventBus.$emit('redirect-schedule', {
                //     route: 'ProcedureCreate',
                //     schedule: this.schedule
                // })
            },
            updateProcedure(procedure, update) {
                this.$parent.update({
                    axios: {
                        method: 'PATCH',
                        url: this.$route.fullPath + procedure.id,
                        data: {
                            content: update.content,
                            content_type: update.content_type,
                            state: update.state
                        }
                    },
                    callback: (process) => {
                        if (process.updated) {
                            return true
                        }
                    }
                })
            },
            deleteProcedure(procedure, index) {

                this.$parent.delete({
                    axios: {
                        method: 'DELETE',
                        url: this.$route.fullPath + procedure.id
                    }
                }).then(state => {
                    if (state.deleted) {
                        this.$refs['procedure'][index].remove()
                    }
                })


                // window.axios({
                //     method: this.router.procedure.delete.method,
                //     url: this.router.procedure.delete.action.replace('{schedule}', this.schedule.id).replace('{procedure}', procedure.id)
                // }).then(response => {
                //     if (response.status === 200 && response.data.deleted === true) {
                //         this.$refs['procedure'][index].remove()
                //     }
                // })
            },
            setProcedureState(procedure, state) {

                if (this.mode === 'new') {
                    procedure.state = state
                } else {
                    if (procedure.state !== state) {
                        const copy = procedure
                        copy.state = state
                        if (this.updateProcedure(procedure, copy)) {
                            procedure.state = state
                        }

                    }
                }

            },
            editContent(procedure, index, event) {
                const wrapper = this.$refs['edit-procedure-content'][index]
                const el = wrapper.children[0]
                if (this.mode === 'view') {
                    el.removeAttribute('style')
                    el.removeAttribute('disabled')
                    event.originalTarget.innerText = 'Save'
                    this.mode = 'edit'
                } else if (this.mode === 'edit') {
                    this.updateProcedure(procedure, {
                        content: procedure.content,
                        content_type: procedure.content,
                        state: procedure.state
                    })
                    el.setAttribute('style', 'resize: none')
                    el.setAttribute('disabled', 'disabled')
                    event.originalTarget.innerText = 'Edit'
                    this.mode = 'view'
                }
            }
        },
        beforeMount() {
            this.schedule = this.$route.params.schedule
            this.$parent.setComponent({
                current: this.$route.name,
                title: this.$route.name
            })
            this.$parent.index({
                axios: {
                    method: 'GET',
                    url: this.$route.fullPath
                },
                callback: (data) => {
                    this.procedures = data
                }
            })
        }
    }
</script>
