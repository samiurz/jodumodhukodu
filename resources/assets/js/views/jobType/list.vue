<template>
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <strong>Job Type</strong>
                        <small>Form</small>
                        <router-link :to="{ name: 'Job Type Form'}">
                            <button class="btn btn-warning">Add</button>
                        </router-link>
                    </div>
                    <div class="card-block">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Company Name</th>
                                    <th>Type</th>
                                    <th>Comments</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="jobType in jobTypes" v-bind:key="jobType.id">
                                    <td>{{ jobType.company.name }}</td>
                                    <td>{{ jobType.type }}</td>
                                    <td>{{ jobType.comments }}</td>
                                    <td>                                        
                                        <router-link :to="{ name: 'Job Type Form', params: { data: jobType }}">
                                            <button class="btn btn-warning mb-2">Edit</button>
                                        </router-link>
                                    </td>
                                    <td>
                                        <button @click="deleteJobType(jobType.id)" class="btn btn-danger">Delete</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <ul class="pagination">
                            <li v-bind:class="[{disabled: !pagination.prev_page_url}]" class="page-item">
                                <a class="page-link" href="#" @click="fetchJobTypes(pagination.prev_page_url)">Previous</a>
                            </li>

                            <li class="page-item disabled">
                                <a class="page-link text-dark" href="#">Page {{ pagination.current_page }} of {{ pagination.last_page }}</a>
                            </li>

                            <li v-bind:class="[{disabled: !pagination.next_page_url}]" class="page-item">
                                <a class="page-link" href="#" @click="fetchJobTypes(pagination.next_page_url)">Next</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/.col-->
</template>
<script>
    export default {
        name: "jobType",
        data() {
            return {
                selectedAccount: "",
                companies:[],
                jobTypes: [],
                jobType: {
                    id: "",
                    company_id: "",
                    type: "",
                    comments: "",
                    is_enabled:"",
                    created_by:"",
                    update_by: "1"
                },
                id: "",
                pagination: {},
                edit: false
            };
        },

        created() {
            this.fetchJobTypes();
        },

        methods: {
            fetchJobTypes(page_url) {
                let vm = this;
                page_url = page_url || "/api/jobTypes";
                fetch(page_url)
                    .then(res => res.json())
                    .then(res => {
                        this.jobTypes = res.data;
                        console.log(this.jobTypes);
                        vm.makePagination(res.meta, res.links);
                    })
                    .catch(err => console.log(err));
            },
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
            deleteJobType(id) {
                if (confirm("Are You Sure?")) {
                    fetch(`api/jobType/${id}`, {
                        method: "delete"
                    })
                        .then(res => res.json())
                        .then(data => {
                            alert("Job Type Removed");
                            this.fetchJobTypes();
                        })
                        .catch(err => console.log(err));
                }
            }
        }
    };
</script>