<template>
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <strong>Fault Type</strong>
                        <small>Form</small>
                        <router-link :to="{ name: 'Fault Type Form'}">
                            <button class="btn btn-warning">Add</button>
                        </router-link>
                    </div>
                    <div class="card-block">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Company Name</th>
                                    <th>Asset Name</th>
                                    <th>Type</th>
                                    <th>Comments</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="faultType in faultTypes" v-bind:key="faultType.id">
                                    <td>{{ faultType.company.name }}</td>
                                    <td>{{ faultType.asset_id }}</td>
                                    <td>{{ faultType.type }}</td>
                                    <td>{{ faultType.comments }}</td>
                                    <td>                                        
                                        <router-link :to="{ name: 'Fault Type Form', params: { data: faultType }}">
                                            <button class="btn btn-warning mb-2">Edit</button>
                                        </router-link>
                                    </td>
                                    <td>
                                        <button @click="deleteFaultType(faultType.id)" class="btn btn-danger">Delete</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <ul class="pagination">
                            <li v-bind:class="[{disabled: !pagination.prev_page_url}]" class="page-item">
                                <a class="page-link" href="#" @click="fetchFaultTypes(pagination.prev_page_url)">Previous</a>
                            </li>

                            <li class="page-item disabled">
                                <a class="page-link text-dark" href="#">Page {{ pagination.current_page }} of {{ pagination.last_page }}</a>
                            </li>

                            <li v-bind:class="[{disabled: !pagination.next_page_url}]" class="page-item">
                                <a class="page-link" href="#" @click="fetchFaultTypes(pagination.next_page_url)">Next</a>
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
        name: "faultType",
        data() {
            return {
                selectedAccount: "",
                companies:[],
                faultTypes: [],
                faultType: {
                    id: "",
                    company_id: "",
                    asset_id: "",
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
            this.fetchFaultTypes();
            this.fetchCompanies();
        },

        methods: {
            fetchFaultTypes(page_url) {
                let vm = this;
                page_url = page_url || "/api/faultTypes";
                fetch(page_url)
                    .then(res => res.json())
                    .then(res => {
                        this.faultTypes = res.data;
                        console.log(this.faultTypes);
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
            deleteFaultType(id) {
                if (confirm("Are You Sure?")) {
                    fetch(`api/faultType/${id}`, {
                        method: "delete"
                    })
                        .then(res => res.json())
                        .then(data => {
                            alert("Fault Type Removed");
                            this.fetchFaultTypes();
                        })
                        .catch(err => console.log(err));
                }
            }
        }
    };
</script>