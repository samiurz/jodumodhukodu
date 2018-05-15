<template>
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <strong>Repair Type</strong>
                        <small>Form</small>
                        <router-link :to="{ name: 'Repair Type Form'}">
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
                                <tr v-for="repairType in repairTypes" v-bind:key="repairType.id">
                                    <td>{{ repairType.company.name }}</td>
                                    <td>{{ repairType.type }}</td>
                                    <td>{{ repairType.comments }}</td>
                                    <td>                                        
                                        <router-link :to="{ name: 'Repair Type Form', params: { data: repairType }}">
                                            <button class="btn btn-warning mb-2">Edit</button>
                                        </router-link>
                                    </td>
                                    <td>
                                        <button @click="deleteRepairType(repairType.id)" class="btn btn-danger">Delete</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <ul class="pagination">
                            <li v-bind:class="[{disabled: !pagination.prev_page_url}]" class="page-item">
                                <a class="page-link" href="#" @click="fetchRepairTypes(pagination.prev_page_url)">Previous</a>
                            </li>

                            <li class="page-item disabled">
                                <a class="page-link text-dark" href="#">Page {{ pagination.current_page }} of {{ pagination.last_page }}</a>
                            </li>

                            <li v-bind:class="[{disabled: !pagination.next_page_url}]" class="page-item">
                                <a class="page-link" href="#" @click="fetchRepairTypes(pagination.next_page_url)">Next</a>
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
        name: "repairType",
        data() {
            return {
                repairTypes: [],
                repairType: {
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
            this.fetchRepairTypes();
        },

        methods: {
            fetchRepairTypes(page_url) {
                let vm = this;
                page_url = page_url || "/api/repairTypes";
                fetch(page_url)
                    .then(res => res.json())
                    .then(res => {
                        this.repairTypes = res.data;
                        console.log(this.repairTypes);
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
            deleteRepairType(id) {
                if (confirm("Are You Sure?")) {
                    fetch(`api/repairType/${id}`, {
                        method: "delete"
                    })
                        .then(res => res.json())
                        .then(data => {
                            alert("Repair Type Removed");
                            this.fetchRepairTypes();
                        })
                        .catch(err => console.log(err));
                }
            }
        }
    };
</script>