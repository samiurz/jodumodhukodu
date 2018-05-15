<template>
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <strong>Activity</strong>
                        <small>Form</small>
                    </div>
                    <div class="card-block">
                        <form @submit.prevent="addDocumentationType" class="mb-3">
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label class="col-md-3 form-control-label" for="select">Select Contact</label>
                                    <select id="select" type="select" class="form-control" v-model="customerBlockModuleActivity.contact_id">
                                        <option value="">Select Contact</option>
                                        <option v-for="contact in contacts" v-bind:key="contact.id" v-bind:value="contact.id">{{contact.name}}</option>
                                    </select>
                                </div>
                                 <div class="form-group col-sm-6">
                                    <label class="col-md-3 form-control-label" for="select">Select Block</label>
                                    <select id="select" type="select" class="form-control" v-model="customerBlockModuleActivity.customer_block_id">
                                        <option value="">Select a Block</option>
                                        <option v-for="block in blocks" v-bind:key="block.id" v-bind:value="block.id">{{block.name}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label class="col-md-3 form-control-label" for="select">Select Module</label>
                                    <select id="select" type="select" class="form-control" v-model="customerBlockModuleActivity.module_id">
                                        <option value="">Select a Module</option>
                                        <option v-for="module in modules" v-bind:key="module.id" v-bind:value="module.id">{{module.name}}</option>
                                    </select>
                                </div>
                                  <div class="form-group col-sm-6">
                                    <label class="col-md-3 form-control-label" for="select">Select Activity</label>
                                    <select id="select" type="select" class="form-control" v-model="customerBlockModuleActivity.activity_id">
                                        <option value="">Select Activity</option>
                                        <option v-for="activity in activities" v-bind:key="activity.id" v-bind:value="activity.id">{{activity.name}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-actions">
                                <button type="submit" class="btn btn-primary">Save changes</button>
                                <router-link :to="{ type: 'Customer Block Module Activity List'}">
                                    <button type="button" class="btn btn-default">Cancel</button>
                                </router-link>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/.col-->
</template>
<script>
    export default {
        type: "documenttype",
        data() {
            return {
                blocks:[],
                contacts: [],
                activities: [],
                modules:[],
                customerBlockModuleActivity: {
                    id: "",
                    contact_id: "",
                    customer_block_id: "",
                    module_id:"",
                    activity_id:"",
                    comments:"",
                    is_enabled:"1",
                    created_by:"1",
                    update_by: "1"
                },
                id: "",
                edit: false
            };
        },
        created() {
            console.log(this.$route.params.data);
            this.fetchContacts();
            this.fetchBlocks();
            this.fetchModules();
            this.fetchActivities();
            if (this.$route.params.data != undefined)
                this.editdocumentationType(this.$route.params.data);
        },
        methods: {
            fetchContacts(page_url) {
                let vm = this;
                page_url = page_url || "/api/contacts";
                fetch(page_url)
                    .then(res => res.json())
                    .then(res => {
                        this.contacts = res.data;
                        console.log(this.contacts);
                    })
                    .catch(err => console.log(err));
            },
            fetchModules(page_url) {
                let vm = this;
                page_url = page_url || "/api/modules";
                fetch(page_url)
                    .then(res => res.json())
                    .then(res => {
                        this.modules = res.data;
                        console.log(this.modules);
                    })
                    .catch(err => console.log(err));
            },
            fetchBlocks(page_url) {
                let vm = this;
                page_url = page_url || "/api/blocks";
                fetch(page_url)
                    .then(res => res.json())
                    .then(res => {
                        this.blocks = res.data;
                        console.log(this.blocks);
                    })
                    .catch(err => console.log(err));
            },
            fetchActivities(page_url) {
                let vm = this;
                page_url = page_url || "/api/activities";
                fetch(page_url)
                    .then(res => res.json())
                    .then(res => {
                        this.activities = res.data;
                        console.log(this.activities);
                    })
                    .catch(err => console.log(err));
            },
            addDocumentationType() {
                if (this.edit === false) {
                    // Add
                    fetch("api/documentationType", {
                        method: "post",
                        body: JSON.stringify(this.documentationType),
                        headers: {
                            "content-type": "application/json"
                        }
                    })
                        .then(res => res.json())
                        .then(data => {
                            this.documentationType.id = "";
                            this.documentationType.company_id = "";
                            this.documentationType.type = "";
                            this.documentationType.comments = "";
                            this.documentationType.is_enabled = "";
                            this.documentationType.created_by = "";
                            this.documentationType.update_by = "";
                            alert("documentation type Added");
                            this.$router.push("/documentationType/list");
                        })
                        .catch(err => console.log(err));
                } else {
                    // Update
                    fetch("api/documentationType", {
                        method: "put",
                        body: JSON.stringify(this.documentationType),
                        headers: {
                            "content-type": "application/json"
                        }
                    })
                        .then(res => res.json())
                        .then(data => {
                            this.documentationType.type = "";
                            this.documentationType.comments = "";
                            alert("documentation type Updated");
                            this.$router.push("/documentationType/list");
                        })
                        .catch(err => console.log(err));
                }
            },
            editdocumentationType(documentationType) {
                this.edit = true;
                this.documentationType.id = documentationType.id;
                this.documentationType.company_id = documentationType.company_id;
                this.documentationType.type = documentationType.type;
                this.documentationType.comments = documentationType.comments;
                this.documentationType.is_enabled = documentationType.is_enabled;
                this.documentationType.created_by = documentationType.created_by;
                this.documentationType.update_by = documentationType.update_by;
            }
        }
    };
</script>