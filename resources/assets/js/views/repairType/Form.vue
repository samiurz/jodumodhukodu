<template>
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <strong>Document Type</strong>
                        <small>Form</small>
                    </div>
                    <div class="card-block">
                        <form @submit.prevent="addRepairType" class="mb-3">
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label class="col-md-3 form-control-label" for="select">companys</label>
                                    <select id="select" type="select" class="form-control" v-model="repairType.company_id">
                                        <option value="">Select a company</option>
                                        <option v-for="company in companies" v-bind:key="company.id" v-bind:value="company.id">{{company.name}}</option>
                                    </select>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="repairType">Type</label>
                                    <input type="text" class="form-control" v-model="repairType.type" placeholder="Phone">
                                </div>
                            </div>
                            <div class="row">
                                  <div class="form-group col-sm-12">
                                    <label for="country">Comments</label>
                                    <textarea id="comments" type="textarea-input" rows="9" class="form-control" v-model="repairType.comments" placeholder="Comments.."></textarea>
                                </div>
                            </div>
                            <div class="form-actions">
                                <button type="submit" class="btn btn-primary">Save changes</button>
                                <router-link :to="{ type: 'Repair Type List'}">
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
        type: "repairType",
        data() {
            return {
                companies: [],
                repairType: {
                    id: "",
                    company_id: "",
                    type: "",
                    comments:"",
                    is_enabled:"1",
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
                this.editRepairType(this.$route.params.data);
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
            makePagination(meta, links) {
                let pagination = {
                    current_page: meta.current_page,
                    last_page: meta.last_page,
                    next_page_url: links.next,
                    prev_page_url: links.prev
                };
                this.pagination = pagination;
            },
            addRepairType() {
                if (this.edit === false) {
                    // Add
                    fetch("api/repairType", {
                        method: "post",
                        body: JSON.stringify(this.repairType),
                        headers: {
                            "content-type": "application/json"
                        }
                    })
                        .then(res => res.json())
                        .then(data => {
                            this.repairType.id = "";
                            this.repairType.company_id = "";
                            this.repairType.type = "";
                            this.repairType.comments = "";
                            this.repairType.is_enabled = "";
                            this.repairType.created_by = "";
                            this.repairType.update_by = "";
                            alert("Repair Type Added");
                            this.$router.push("/repairType/list");
                        })
                        .catch(err => console.log(err));
                } else {
                    // Update
                    fetch("api/repairType", {
                        method: "put",
                        body: JSON.stringify(this.repairType),
                        headers: {
                            "content-type": "application/json"
                        }
                    })
                        .then(res => res.json())
                        .then(data => {
                            this.repairType.type = "";
                            this.repairType.comments = "";
                            this.repairType.type = "";
                            this.repairType.comments = "";
                            this.repairType.is_enabled = "";
                            this.repairType.created_by = "";
                            this.repairType.update_by = "";
                            alert("Repair Type Updated");
                            this.$router.push("/repairType/list");
                        })
                        .catch(err => console.log(err));
                }
            },
            editRepairType(repairType) {
                this.edit = true;
                this.repairType.id = repairType.id;
                this.repairType.company_id = repairType.company_id;
                this.repairType.type = repairType.type;
                this.repairType.comments = repairType.comments;
                this.repairType.is_enabled = repairType.is_enabled;
                this.repairType.created_by = repairType.created_by;
                this.repairType.update_by = repairType.update_by;
            }
        }
    };
</script>