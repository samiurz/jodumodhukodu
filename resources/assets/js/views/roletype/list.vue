<template>
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <strong>Role Type</strong>
                        <small>Form</small>
                        <router-link :to="{ name: 'Role Type Form'}">
                            <button class="btn btn-warning">Add</button>
                        </router-link>
                    </div>
                    <div class="card-block">
                        <div class="card">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>name</th>
                                        <th>comments</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="roletype in roletypes" v-bind:key="roletype.id">
                                        <td>{{ roletype.name }}</td>
                                        <td>{{ roletype.comments }}</td>
                                        <td>
                                                <router-link :to="{ name: 'Role Type Form', params: { id: roletype }}">
                                                     <button class="btn btn-warning mb-2">Edit</button>
                                                </router-link>
                                        </td>
                                        <td>
                                            <button @click="deleteroletype(roletype.id)" class="btn btn-danger">Delete</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <ul class="pagination">
                                <li v-bind:class="[{disabled: !pagination.prev_page_url}]" class="page-item">
                                    <a class="page-link" href="#" @click="fetchroletypes(pagination.prev_page_url)">Previous</a>
                                </li>

                                <li class="page-item disabled">
                                    <a class="page-link text-dark" href="#">Page {{ pagination.current_page }} of {{ pagination.last_page }}</a>
                                </li>

                                <li v-bind:class="[{disabled: !pagination.next_page_url}]" class="page-item">
                                    <a class="page-link" href="#" @click="fetchroletypes(pagination.next_page_url)">Next</a>
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
        name: "roletype",
        data() {
            return {
                roletypes: [],
                roletype: {
                    id: "",
                    name: "",
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
            this.fetchroletypes();
        },
        methods: {
            fetchroletypes(page_url) {
                let vm = this;
                page_url = page_url || "/api/roletypes";
                fetch(page_url)
                    .then(res => res.json())
                    .then(res => {
                        this.roletypes = res.data;
                        console.log(this.roletypes);
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
            deleteroletype(id) {
                if (confirm("Are You Sure?")) {
                    fetch(`api/roletype/${id}`, {
                        method: "delete"
                    })
                        .then(res => res.json())
                        .then(data => {
                            alert("roletype Removed");
                            this.fetchroletypes();
                        })
                        .catch(err => console.log(err));
                }
            }
        }
    };
</script>