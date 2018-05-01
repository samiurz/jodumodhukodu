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
                        <form @submit.prevent="addJobType" class="mb-3">
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label class="col-md-3 form-control-label" for="select">companys</label>
                                    <select id="select" type="select" class="form-control" v-model="jobType.company_id">
                                        <option value="">Select a company</option>
                                        <option v-for="company in companies" v-bind:key="company.id" v-bind:value="company.id">{{company.name}}</option>
                                    </select>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="jobType">Type</label>
                                    <input type="text" class="form-control" v-model="jobType.type" placeholder="Job Type">
                                </div>
                            </div>
                            <div class="row">
                                  <div class="form-group col-sm-12">
                                    <label for="country">Comments</label>
                                    <textarea id="comments" type="textarea-input" rows="9" class="form-control" v-model="jobType.comments" placeholder="Comments.."></textarea>
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
                jobTypes: [],
                companies: [],
                jobType: {
                    id: "",
                    company_id: "",
                    type: "",
                    comments:"",
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
                this.editJobType(this.$route.params.data);
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
            addJobType() {
                if (this.edit === false) {
                    // Add
                    fetch("api/jobType", {
                        method: "post",
                        body: JSON.stringify(this.jobType),
                        headers: {
                            "content-type": "application/json"
                        }
                    })
                        .then(res => res.json())
                        .then(data => {
                            this.jobType.id = "";
                            this.jobType.company_id = "";
                            this.jobType.type = "";
                            this.jobType.comments = "";
                            this.jobType.update_by = "";
                            alert("Job type Added");
                            this.$router.push("/jobType/list");
                        })
                        .catch(err => console.log(err));
                } else {
                    // Update
                    fetch("api/jobType", {
                        method: "put",
                        body: JSON.stringify(this.jobType),
                        headers: {
                            "content-type": "application/json"
                        }
                    })
                        .then(res => res.json())
                        .then(data => {
                            this.jobType.type = "";
                            this.jobType.comments = "";
                            alert("Job type Updated");
                            this.$router.push("/jobType/list");
                        })
                        .catch(err => console.log(err));
                }
            },
            editJobType(jobType) {
                this.edit = true;
                this.jobType.id = jobType.id;
                this.jobType.company_id = jobType.company_id;
                this.jobType.type = jobType.type;
                this.jobType.comments = jobType.comments;
                this.jobType.update_by = jobType.update_by;
            }
        }
    };
</script>