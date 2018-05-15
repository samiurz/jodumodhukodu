<template>
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <strong>Document Type</strong>
                        <small>Form</small>
                        <router-link :to="{ name: 'Documentation Type Form'}">
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
                                <tr v-for="documentationType in documentationTypes" v-bind:key="documentationType.id">
                                    <td>{{ documentationType.company.name }}</td>
                                    <td>{{ documentationType.type }}</td>
                                    <td>{{ documentationType.comments }}</td>
                                    <td>                                        
                                        <router-link :to="{ name: 'Documentation Type Form', params: { data: documentationType }}">
                                            <button class="btn btn-warning mb-2">Edit</button>
                                        </router-link>
                                    </td>
                                    <td>
                                        <button @click="deleteDocumentationType(documentationType.id)" class="btn btn-danger">Delete</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <ul class="pagination">
                            <li v-bind:class="[{disabled: !pagination.prev_page_url}]" class="page-item">
                                <a class="page-link" href="#" @click="fetchdocumentationTypes(pagination.prev_page_url)">Previous</a>
                            </li>

                            <li class="page-item disabled">
                                <a class="page-link text-dark" href="#">Page {{ pagination.current_page }} of {{ pagination.last_page }}</a>
                            </li>

                            <li v-bind:class="[{disabled: !pagination.next_page_url}]" class="page-item">
                                <a class="page-link" href="#" @click="fetchdocumentationTypes(pagination.next_page_url)">Next</a>
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
        name: "documentationType",
        data() {
            return {
                selectedAccount: "",
                documentationTypes: [],
                companies:[],
                documentationType: {
                    id: "",
                    company_id: "",
                    type: "",
                    comments: "",
                    is_enabled:"",
                    created_by:"1",
                    update_by: "1"
                },
                id: "",
                pagination: {},
                edit: false
            };
        },

        created() {
            this.fetchdocumentationTypes();
            this.fetchCompanies();
        },

        methods: {
            fetchdocumentationTypes(page_url) {
                let vm = this;
                page_url = page_url || "/api/documentationTypes";
                fetch(page_url)
                    .then(res => res.json())
                    .then(res => {
                        this.documentationTypes = res.data;
                        console.log(this.documentationTypes);
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
            deleteDocumentationType(id) {
                if (confirm("Are You Sure?")) {
                    fetch(`api/documentationType/${id}`, {
                        method: "delete"
                    })
                        .then(res => res.json())
                        .then(data => {
                            alert("Documentation Type Removed");
                            this.fetchdocumentationTypes();
                        })
                        .catch(err => console.log(err));
                }
            }
        }
    };
</script>