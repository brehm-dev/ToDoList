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
                        <button class="btn btn-success"
                            @click="createProcedure"
                        >new ToDo</button>
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
    import { bus } from '../../app'

    export default {
        name: 'ProcedureIndex',
        data: function () {
            return {
                procedures: {},
                mode: 'view',
                newProcedure: {}
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
            createProcedure(schedule) {
                // this.mode = 'new'
                bus.$emit('redirect-schedule', {
                    route: 'ProcedureCreate',
                    schedule: this.schedule
                })
            },
            updateProcedure(procedure, update) {
                window.axios({
                    method: this.route.update.method,
                    url: this.route.update.action.replace('{schedule}', this.schedule.id).replace('{procedure}', procedure.id),
                    data: {
                        content: update.content,
                        content_type: update.content_type,
                        state: update.state
                    }
                }).then(response => {
                    // console.log(response.data)
                }).catch(e => {
                    console.log(e)
                })
            },
            deleteProcedure(procedure, index) {
                window.axios({
                    method: this.route.delete.method,
                    url: this.route.delete.action.replace('{schedule}', this.schedule.id).replace('{procedure}', procedure.id)
                }).then(response => {
                    if (response.status === 200 && response.data.deleted === true) {
                        console.log(this.$refs['procedure'][index].remove())
                    }
                })
            },
            setProcedureState(procedure, state) {
                if (this.mode === 'new') {
                    procedure.state = state
                } else {
                    if (procedure.state !== state) {
                        procedure.state = state
                        this.updateProcedure(procedure, {
                            content: procedure.content,
                            content_type: procedure.content_type,
                            state: state
                        })
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
        created() {
            window.axios({
                method: this.route.index.method,
                url: this.route.index.action.replace('{schedule}', this.schedule.id)
            }).then(response => {
                this.procedures = response.data
            })
        },
    }
</script>
