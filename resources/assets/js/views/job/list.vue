<template>
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <strong>Job Priority</strong>
                        <small>Form</small>
                        <router-link :to="{ name: 'Job Form'}">
                            <button class="btn btn-warning">Add</button>
                        </router-link>
                    </div>
                    <div class="card-block">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Company Name</th>
                                    <th>Priority</th>
                                    <th>Comments</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="jobPriority in jobPriorities" v-bind:key="jobPriority.id">
                                    <td>{{ jobPriority.company.name }}</td>
                                    <td>{{ jobPriority.priority }}</td>
                                    <td>{{ jobPriority.comments }}</td>
                                    <td>                                        
                                        <router-link :to="{ name: 'Job Priority Form', params: { data: jobPriority }}">
                                            <button class="btn btn-warning mb-2">Edit</button>
                                        </router-link>
                                    </td>
                                    <td>
                                        <button @click="deleteJobPriority(jobPriority.id)" class="btn btn-danger">Delete</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <ul class="pagination">
                            <li v-bind:class="[{disabled: !pagination.prev_page_url}]" class="page-item">
                                <a class="page-link" href="#" @click="fetchjobPriorities(pagination.prev_page_url)">Previous</a>
                            </li>

                            <li class="page-item disabled">
                                <a class="page-link text-dark" href="#">Page {{ pagination.current_page }} of {{ pagination.last_page }}</a>
                            </li>

                            <li v-bind:class="[{disabled: !pagination.next_page_url}]" class="page-item">
                                <a class="page-link" href="#" @click="fetchjobPriorities(pagination.next_page_url)">Next</a>
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
        name: "jobPriority",
        data() {
            return {
                selectedAccount: "",
                companies:[],
                jobPriorities: [],
                jobPriority: {
                    id: "",
                    company_id: "",
                    priority:"",
                    comments: "",
                    update_by: "1"
                },
                id: "",
                pagination: {},
                edit: false
            };
        },

        created() {
            this.fetchjobPriorities();
            this.fetchCompanies();
        },

        methods: {
            fetchjobPriorities(page_url) {
                let vm = this;
                page_url = page_url || "/api/jobPriorities";
                fetch(page_url)
                    .then(res => res.json())
                    .then(res => {
                        this.jobPriorities = res.data;
                        console.log(this.jobPriorities);
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
            deleteJobPriority(id) {
                if (confirm("Are You Sure?")) {
                    fetch(`api/jobPriority/${id}`, {
                        method: "delete"
                    })
                        .then(res => res.json())
                        .then(data => {
                            alert("Job Priority Removed");
                            this.fetchjobPriorities();
                        })
                        .catch(err => console.log(err));
                }
            }
        }
    };
</script>