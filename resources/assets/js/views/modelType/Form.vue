<template>
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <strong> Job Type</strong>
                        <small>Form</small>
                    </div>
                    <div class="card-block">
                        <form @submit.prevent="addModelType" class="mb-3">
                            <div class="row">
                                <div class="form-group col-sm-4">
                                    <label class="col-md-3 form-control-label" for="select">companys</label>
                                    <select id="select" type="select" class="form-control" v-model="modelType.company_id">
                                        <option value="">Select a company</option>
                                        <option v-for="company in companies" v-bind:key="company.id" v-bind:value="company.id">{{company.name}}</option>
                                    </select>
                                </div>
                                 <div class="form-group col-sm-4">
                                    <label for="modelType">Model Make</label>
                                    <input type="text" class="form-control" v-model="modelType.make" placeholder="Rhea">
                                </div>
                                <div class="form-group col-sm-4">
                                    <label for="modelType">Type</label>
                                    <input type="text" class="form-control" v-model="modelType.type" placeholder="Job Type">
                                </div>
                            </div>
                            <div class="row">
                                  <div class="form-group col-sm-12">
                                    <label for="country">Comments</label>
                                    <textarea id="comments" type="textarea-input" rows="9" class="form-control" v-model="modelType.comments" placeholder="Comments.."></textarea>
                                </div>
                            </div>
                            <div class="form-actions">
                                <button type="submit" class="btn btn-primary">Save changes</button>
                                <router-link :to="{ type: 'Job Type List'}">
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
                selectedCompany: 1,
                modelTypes: [],
                companies: [],
                modelType: {
                    id: "",
                    company_id: "",
                    make:"",
                    type: "",
                    is_enabled:"1",
                    comments:"",
                    created_by:"1",
                    update_by: "1"
                },
                id: "",
                pagination: {},
                edit: false
            };
        },
        created() {
            console.log(this.$route.params.data);
            this.fetchCompanies();
            if (this.$route.params.data != undefined)
                this.editmodelType(this.$route.params.data);
        },
        methods: {
            fetchCompanies(page_url) {
                let vm = this;
                page_url = page_url || "/api/companies";
                fetch(page_url)
                    .then(res => res.json())
                    .then(res => {
                        this.companies = res.data;
                        console.log(this.companies);
                        vm.makePagination(res.meta, res.links);
                    })
                    .catch(err => console.log(err));
            },
            makePagination(meta, links) {
                let pagination = {
                    current_page: meta.current_page,
                    last_page: meta.last_page,
                    next_page_url: links.next,
                    prev_page_url: links.prev
                };
                this.pagination = pagination;
            },
            addModelType() {
                if (this.edit === false) {
                    // Add
                    fetch("api/modelType", {
                        method: "post",
                        body: JSON.stringify(this.modelType),
                        headers: {
                            "content-type": "application/json"
                        }
                    })
                        .then(res => res.json())
                        .then(data => {
                            this.modelType.id = "";
                            this.modelType.company_id = "";
                            this.modelType.make = "";
                            this.modelType.type = "";
                            this.modelType.comments = "";
                            this.modelType.is_enabled = "";
                            this.modelType.created_by = "";
                            this.modelType.update_by = "";
                            alert("Model type Added");
                            this.$router.push("/modelType/list");
                        })
                        .catch(err => console.log(err));
                } else {
                    // Update
                    fetch("api/modelType", {
                        method: "put",
                        body: JSON.stringify(this.modelType),
                        headers: {
                            "content-type": "application/json"
                        }
                    })
                        .then(res => res.json())
                        .then(data => {
                            this.modelType.type = "";
                            this.modelType.comments = "";
                            this.modelType.is_enabled = "";
                            this.modelType.created_by = "";
                            this.modelType.update_by = "";
                            alert("Model type Updated");
                            this.$router.push("/modelType/list");
                        })
                        .catch(err => console.log(err));
                }
            },
            editmodelType(modelType) {
                this.edit = true;
                this.modelType.id = modelType.id;
                this.modelType.make = modelType.make;
                this.modelType.company_id = modelType.company_id;
                this.modelType.type = modelType.type;
                this.modelType.comments = modelType.comments;
                this.modelType.created_by = modelType.created_by;
                this.modelType.is_enabled = modelType.is_enabled;
                this.modelType.update_by = modelType.update_by;
            }
        }
    };
</script>