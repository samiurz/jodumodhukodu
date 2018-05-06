<template>
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <strong>Manufacturer Type</strong>
                        <small>Form</small>
                        <router-link :to="{ name:'Manufacturer Form'}">
                            <button class="btn btn-warning">Add</button>
                        </router-link>
                    </div>
                    <div class="card-block">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Company Name</th>
                                    <th>Name</th>
                                    <th>Comments</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="manufacturer in manufacturers" v-bind:key="manufacturer.id">
                                    <td>{{ manufacturer.company_id }}</td>
                                    <td>{{ manufacturer.name }}</td>
                                    <td>{{ manufacturer.comments }}</td>
                                    <td>                                        
                                        <router-link :to="{ name: 'Manufacturer Form', params: { data: manufacturer }}">
                                            <button class="btn btn-warning mb-2">Edit</button>
                                        </router-link>
                                    </td>
                                    <td>
                                        <button @click="deleteManufacturer(manufacturer.id)" class="btn btn-danger">Delete</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <ul class="pagination">
                            <li v-bind:class="[{disabled: !pagination.prev_page_url}]" class="page-item">
                                <a class="page-link" href="#" @click="fetchManufacturers(pagination.prev_page_url)">Previous</a>
                            </li>

                            <li class="page-item disabled">
                                <a class="page-link text-dark" href="#">Page {{ pagination.current_page }} of {{ pagination.last_page }}</a>
                            </li>

                            <li v-bind:class="[{disabled: !pagination.next_page_url}]" class="page-item">
                                <a class="page-link" href="#" @click="fetchManufacturers(pagination.next_page_url)">Next</a>
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
        name: "manufacturer",
        data() {
            return {
                selectedAccount: "",
                companies:[],
                manufacturers: [],
                manufacturer: {
                    id: "",
                    company_id: "",
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
            this.fetchManufacturers();
            this.fetchCompanies();
        },

        methods: {
            fetchManufacturers(page_url) {
                let vm = this;
                page_url = page_url || "/api/manufacturers";
                fetch(page_url)
                    .then(res => res.json())
                    .then(res => {
                        this.manufacturers = res.data;
                        console.log(this.manufacturers);
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
            deleteManufacturer(id) {
                if (confirm("Are You Sure?")) {
                    fetch(`api/manufacturer/${id}`, {
                        method: "delete"
                    })
                        .then(res => res.json())
                        .then(data => {
                            alert("Manufacturer Removed");
                            this.fetchManufacturers();
                        })
                        .catch(err => console.log(err));
                }
            }
        }
    };
</script>