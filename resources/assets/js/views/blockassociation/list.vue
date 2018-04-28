<template>
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <strong>Block Association</strong>
                        <small>Form</small>
                        <router-link :to="{ name: 'Block Association Form'}">
                            <button class="btn btn-warning">Add</button>
                        </router-link>
                    </div>
                    <div class="card-company">
                        <div class="card">
                            <table class="table" v-for="company in companies" v-bind:key="company.id">
                                <thead>
                                    <tr>
                                        <th>Account Name</th>
                                        <th>Block Name</th>
                                        <th>Block Status</th>
                                        <th>Update By</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ company.account_id }}</td>
                                        <td>{{ company.company_name }}</td>
                                        <td>{{ company.is_customer }}</td>
                                        <td>{{ company.links }}</td>
                                        <td>{{ company.email }}</td>
                                        <td>{{ company.address }}</td>
                                        <td>{{ company.update_by }}</td>
                                        <td>
                                            <button class="btn btn-warning mb-2">
                                                <router-link :to="{ name: 'Company Form', params: { data: company }}">Edit</router-link>
                                            </button>
                                        </td>
                                        <td>
                                            <button @click="deletecompany(company.id)" class="btn btn-danger">Delete</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <ul class="pagination">
                                <li v-bind:class="[{disabled: !pagination.prev_page_url}]" class="page-item">
                                    <a class="page-link" href="#" @click="fetchcompanies(pagination.prev_page_url)">Previous</a>
                                </li>

                                <li class="page-item disabled">
                                    <a class="page-link text-dark" href="#">Page {{ pagination.current_page }} of {{ pagination.last_page }}</a>
                                </li>

                                <li v-bind:class="[{disabled: !pagination.next_page_url}]" class="page-item">
                                    <a class="page-link" href="#" @click="fetchcompanies(pagination.next_page_url)">Next</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/.col-->
</template>
<script>
    export default {
        name: "blockassociation",
        data() {
            return {
                selectedAccount: "",
                companies: [],
                company: {
                    id: "",
                    account_id: "",
                    company_name: "",
                    is_customer: "",
                    links: "",
                    email: "",
                    address: "",
                    update_by: "1"
                },
                id: "",
                pagination: {},
                edit: false
            };
        },

        created() {
            this.fetchcompanies();
        },

        methods: {
            fetchcompanies(page_url) {
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
            deletecompany(id) {
                if (confirm("Are You Sure?")) {
                    fetch(`api/company/${id}`, {
                        method: "delete"
                    })
                        .then(res => res.json())
                        .then(data => {
                            alert("Company Removed");
                            this.fetchcompanies();
                        })
                        .catch(err => console.log(err));
                }
            }
        }
    };
</script>