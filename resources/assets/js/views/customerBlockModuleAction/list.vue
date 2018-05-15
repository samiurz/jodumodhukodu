<template>
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <strong>Document Type</strong>
                        <small>Form</small>
                        <router-link :to="{ name: 'Customer Block Module Activity Form'}">
                            <button class="btn btn-warning">Add</button>
                        </router-link>
                    </div>
                    <div class="card-block">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Contact Name</th>
                                    <th>Block Name</th>
                                    <th>Module Name</th>
                                    <th>Activity Name</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="customerBlockModuleActivity in customerBlockModuleActivities" v-bind:key="customerBlockModuleActivity.id">
                                    <td>{{ customerBlockModuleActivity.contact_id }}</td>
                                    <td>{{ customerBlockModuleActivity.block_id }}</td>
                                    <td>{{ customerBlockModuleActivity.module_id }}</td>
                                    <td>{{ customerBlockModuleActivity.activity_id }}</td>
                                    <td>{{ customerBlockModuleActivity.comments }}</td>
                                    <td>                                        
                                        <router-link :to="{ name: 'Customer Block Module Activity Form', params: { data: customerBlockModuleActivity }}">
                                            <button class="btn btn-warning mb-2">Edit</button>
                                        </router-link>
                                    </td>
                                    <td>
                                        <button @click="deletecustomerBlockModuleActivity(customerBlockModuleActivity.id)" class="btn btn-danger">Delete</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <ul class="pagination">
                            <li v-bind:class="[{disabled: !pagination.prev_page_url}]" class="page-item">
                                <a class="page-link" href="#" @click="fetchcustomerBlockModuleActivitys(pagination.prev_page_url)">Previous</a>
                            </li>

                            <li class="page-item disabled">
                                <a class="page-link text-dark" href="#">Page {{ pagination.current_page }} of {{ pagination.last_page }}</a>
                            </li>

                            <li v-bind:class="[{disabled: !pagination.next_page_url}]" class="page-item">
                                <a class="page-link" href="#" @click="fetchcustomerBlockModuleActivitys(pagination.next_page_url)">Next</a>
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
        name: "customerBlockModuleActivity",
        data() {
            return {
                selectedAccount: "",
                customerBlockModuleActivitys: [],
                customerBlockModuleActivity: {
                    id: "",
                    contact_id: "",
                    block_id: "",
                    module_id: "",
                    activity_id: "",
                    comments:"",
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
            this.fetchcustomerBlockModuleActivitys();
        },

        methods: {
            fetchcustomerBlockModuleActivitys(page_url) {
                let vm = this;
                page_url = page_url || "/api/customerBlockModuleActivitys";
                fetch(page_url)
                    .then(res => res.json())
                    .then(res => {
                        this.customerBlockModuleActivitys = res.data;
                        console.log(this.customerBlockModuleActivitys);
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
            deletecustomerBlockModuleActivity(id) {
                if (confirm("Are You Sure?")) {
                    fetch(`api/customerBlockModuleActivity/${id}`, {
                        method: "delete"
                    })
                        .then(res => res.json())
                        .then(data => {
                            alert("Documentation Type Removed");
                            this.fetchcustomerBlockModuleActivitys();
                        })
                        .catch(err => console.log(err));
                }
            }
        }
    };
</script>