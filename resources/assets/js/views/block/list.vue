<template>
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <strong>Block</strong>
                        <small>Form</small>
                        <router-link :to="{ name: 'Block Form'}">
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
                                        <tr v-for="block in blocks" v-bind:key="block.id">
                                            <td>{{ block.name }}</td>
                                             <td>{{ block.comments }}</td>
                                            <td> 
                                                 <router-link :to="{ name: 'Block Form', params: { id: block }}">
                                                    <button  class="btn btn-warning mb-2">Edit</button>
                                                </router-link>
                                            </td>
                                            <td> <button @click="deleteBlock(block.id)" class="btn btn-danger">Delete</button></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <ul class="pagination">
                                    <li v-bind:class="[{disabled: !pagination.prev_page_url}]" class="page-item">
                                        <a class="page-link" href="#" @click="fetchBlocks(pagination.prev_page_url)">Previous</a>
                                    </li>
            
                                    <li class="page-item disabled">
                                        <a class="page-link text-dark" href="#">Page {{ pagination.current_page }} of {{ pagination.last_page }}</a>
                                    </li>
            
                                    <li v-bind:class="[{disabled: !pagination.next_page_url}]" class="page-item">
                                        <a class="page-link" href="#" @click="fetchBlocks(pagination.next_page_url)">Next</a>
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
        name: "company",
        data() {
            return {
                selectedblock: "",
                blocks: [],
                block: {
                    id: "",
                    name: "",
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
            this.fetchBlocks();
        },

        methods: {
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
            deleteBlock(id) {
                if (confirm("Are You Sure?")) {
                    fetch(`api/block/${id}`, {
                        method: "delete"
                    })
                        .then(res => res.json())
                        .then(data => {
                            alert("block Removed");
                            this.fetchBlocks();
                        })
                        .catch(err => console.log(err));
                }
            }
        }
    };
</script>