<template>
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <strong>Label</strong>
                        <small>Form</small>
                    </div>
                    <div class="card-block">
                        <form @submit.prevent="addLabel" class="mb-3">
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label class="col-md-3 form-control-label" for="select">companys</label>
                                    <select id="select" type="select" class="form-control" v-model="label.company_id">
                                        <option value="">Select a company</option>
                                        <option v-for="company in companies" v-bind:key="company.id" v-bind:value="company.id">{{company.name}}</option>
                                    </select>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="customer">Name</label>
                                    <input type="text" class="form-control" placeholder="Enter Label Name" v-model="label.name">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label for="customer">Comments</label>
                                    <input type="text" class="form-control" placeholder="Enter Comments" v-model="label.comments">
                                </div>
                            </div>
                            <!--/.row-->
                            <div class="form-actions">
                                <button type="submit" class="btn btn-primary">Save changes</button>
                                <router-link :to="{ name: 'Label List'}">
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
        name: "label",
        data() {
            return {
                selectedblock: "",
                companies: [],
                labels: [],
                label: {
                    id: "",
                    name: "",
                    comments: "",
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
            this.fetchCompanies();
            if (this.$route.params.id != undefined)
                this.editLabel(this.$route.params.id);
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
            fetchlabels(page_url) {
                let vm = this;
                page_url = page_url || "/api/labels";
                fetch(page_url)
                    .then(res => res.json())
                    .then(res => {
                        this.labels = res.data;
                        console.log(this.labels);
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
            deletelabel(id) {
                if (confirm("Are You Sure?")) {
                    fetch(`api/label/${id}`, {
                        method: "delete"
                    })
                        .then(res => res.json())
                        .then(data => {
                            alert("Label Removed");
                            this.fetchlabels();
                        })
                        .catch(err => console.log(err));
                }
            },
            addLabel() {
                if (this.edit === false) {
                    // Add
                    fetch("api/label", {
                        method: "post",
                        body: JSON.stringify(this.label),
                        headers: {
                            "content-type": "application/json"
                        }
                    })
                        .then(res => res.json())
                        .then(data => {
                            this.label.company_id = "";
                            this.label.name = "";
                            this.label.comments = "";
                            this.label.is_enabled = "";
                            this.label.created_by = "";
                            this.label.update_by = "";
                            alert("Label Added");
                            this.$router.push('/label/list');
                        })
                        .catch(err => console.log(err));
                } else {
                    // Update
                    fetch("api/label", {
                        method: "put",
                        body: JSON.stringify(this.label),
                        headers: {
                            "content-type": "application/json"
                        }
                    })
                        .then(res => res.json())
                        .then(data => {
                            this.label.company_id = "";
                            this.label.name = "";
                            this.label.comments = "";
                            this.label.is_enabled = "";
                            this.label.created_by = "";
                            this.label.update_by = "";
                            alert("Label Updated");
                            this.$router.push('/label/list');
                        })
                        .catch(err => console.log(err));
                }
            },
            editLabel(label) {
                this.edit = true;
                this.label.id = label.id;
                this.label.company_id = label.company_id;
                this.label.name = label.name;
                this.label.comments = label.comments;
                this.label.created_by = label.created_by;
                this.label.is_enabled = label.is_enabled;
                this.label.update_by = label.update_by;
            }
        }
    };
</script>