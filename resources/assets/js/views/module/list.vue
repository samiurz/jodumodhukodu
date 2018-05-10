<template>
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <strong>Module</strong>
                        <small>Form</small>
                        <router-link :to="{ name: 'Module Form'}">
                            <button class="btn btn-warning">Add</button>
                        </router-link>
                    </div>
                    <div class="card-block">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Block Name</th>
                                    <th>Module Name</th>
                                    <th>Comments</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="module in modules" v-bind:key="module.id">
                                    <td>{{ module.block.name }}</td>
                                    <td>{{ module.name }}</td>
                                    <td>{{ module.comments }}</td>
                                    <td>                                        
                                        <router-link :to="{ name: 'Module Form', params: { data: module }}">
                                            <button class="btn btn-warning mb-2">Edit</button>
                                        </router-link>
                                    </td>
                                    <td>
                                        <button @click="deleteModule(module.id)" class="btn btn-danger">Delete</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <ul class="pagination">
                            <li v-bind:class="[{disabled: !pagination.prev_page_url}]" class="page-item">
                                <a class="page-link" href="#" @click="fetchModules(pagination.prev_page_url)">Previous</a>
                            </li>

                            <li class="page-item disabled">
                                <a class="page-link text-dark" href="#">Page {{ pagination.current_page }} of {{ pagination.last_page }}</a>
                            </li>

                            <li v-bind:class="[{disabled: !pagination.next_page_url}]" class="page-item">
                                <a class="page-link" href="#" @click="fetchModules(pagination.next_page_url)">Next</a>
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
        name: "module",
        data() {
            return {
                selectedAccount: "",
                blocks:[],
                modules: [],
                module: {
                    id: "",
                    block_id: "",
                    name:"",
                    comments: "",
                    update_by: "1"
                },
                id: "",
                pagination: {},
                edit: false
            };
        },

        created() {
            this.fetchModules();
        },

        methods: {
            fetchModules(page_url) {
                let vm = this;
                page_url = page_url || "/api/modules";
                fetch(page_url)
                    .then(res => res.json())
                    .then(res => {
                        this.modules = res.data;
                        console.log(this.modules);
                        vm.makePagination(res.meta, res.links);
                    })
                    .catch(err => console.log(err));
            },
            fetchBlocks(page_url) {
                let vm = this;
                page_url = page_url || "/api/blocks";
                fetch(page_url)
                    .then(res => res.json())
                    .then(res => {
                        this.blocks = res.data;
                        console.log(this.blocks);
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
            deleteModule(id) {
                if (confirm("Are You Sure?")) {
                    fetch(`api/module/${id}`, {
                        method: "delete"
                    })
                        .then(res => res.json())
                        .then(data => {
                            alert("Module Removed");
                            this.fetchModules();
                        })
                        .catch(err => console.log(err));
                }
            }
        }
    };
</script>