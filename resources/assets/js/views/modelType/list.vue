<template>
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <strong>Model Type</strong>
                        <small>Form</small>
                        <router-link :to="{ name: 'Model Type Form'}">
                            <button class="btn btn-warning">Add</button>
                        </router-link>
                    </div>
                    <div class="card-block">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Company Name</th>
                                    <th>Make</th>
                                    <th>Type</th>
                                    <th>Comments</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="modelType in modelTypes" v-bind:key="modelType.id">
                                    <td>{{ modelType.company.name }}</td>
                                    <td>{{ modelType.make }}</td>
                                    <td>{{ modelType.type }}</td>
                                    <td>{{ modelType.comments }}</td>
                                    <td>                                        
                                        <router-link :to="{ name: 'Model Type Form', params: { data: modelType }}">
                                            <button class="btn btn-warning mb-2">Edit</button>
                                        </router-link>
                                    </td>
                                    <td>
                                        <button @click="deletemodelType(modelType.id)" class="btn btn-danger">Delete</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <ul class="pagination">
                            <li v-bind:class="[{disabled: !pagination.prev_page_url}]" class="page-item">
                                <a class="page-link" href="#" @click="fetchmodelTypes(pagination.prev_page_url)">Previous</a>
                            </li>

                            <li class="page-item disabled">
                                <a class="page-link text-dark" href="#">Page {{ pagination.current_page }} of {{ pagination.last_page }}</a>
                            </li>

                            <li v-bind:class="[{disabled: !pagination.next_page_url}]" class="page-item">
                                <a class="page-link" href="#" @click="fetchmodelTypes(pagination.next_page_url)">Next</a>
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
        name: "modelType",
        data() {
            return {
                selectedAccount: "",
                companies:[],
                modelTypes: [],
                modelType: {
                    id: "",
                    company_id: "",
                    make:"",
                    type: "",
                    comments: "",
                    update_by: "1"
                },
                id: "",
                pagination: {},
                edit: false
            };
        },

        created() {
            this.fetchmodelTypes();
            this.fetchCompanies();
        },

        methods: {
            fetchmodelTypes(page_url) {
                let vm = this;
                page_url = page_url || "/api/modelTypes";
                fetch(page_url)
                    .then(res => res.json())
                    .then(res => {
                        this.modelTypes = res.data;
                        console.log(this.modelTypes);
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
            deletemodelType(id) {
                if (confirm("Are You Sure?")) {
                    fetch(`api/modelType/${id}`, {
                        method: "delete"
                    })
                        .then(res => res.json())
                        .then(data => {
                            alert("Model Type Removed");
                            this.fetchmodelTypes();
                        })
                        .catch(err => console.log(err));
                }
            }
        }
    };
</script>