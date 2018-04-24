<template>
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <strong>block</strong>
                        <small>Form</small>
                    </div>
                    <div class="card-block">
                        <form @submit.prevent="addBlock" class="mb-3">
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label for="customer">Name</label>
                                    <input type="text" class="form-control" placeholder="Enter Block Name" v-model="block.name">
                                </div>
                            </div>
                            <!--/.row-->
                            <div class="form-actions">
                                <button type="submit" class="btn btn-primary">Save changes</button>
                                <button type="button" class="btn btn-default">Cancel</button>
                            </div>
                        </form>
                        
                            <div class="card">
                                <table class="table" v-for="block in blocks" v-bind:key="block.id">
                                    <thead>
                                        <tr>
                                            <th>name</th>
                                            <th>Edit</th>
                                            <th>Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>{{ block.name }}</td>
                                            <td> <button @click="editBlock(block)" class="btn btn-warning mb-2">Edit</button></td>
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
                    blocks_name: "",
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
            },
            addBlock() {
                if (this.edit === false) {
                    // Add
                    fetch("api/block", {
                        method: "post",
                        body: JSON.stringify(this.block),
                        headers: {
                            "content-type": "application/json"
                        }
                    })
                        .then(res => res.json())
                        .then(data => {
                            this.block.name = "";
                            alert("block Added");
                            this.fetchBlocks();
                        })
                        .catch(err => console.log(err));
                } else {
                    // Update
                    fetch("api/block", {
                        method: "put",
                        body: JSON.stringify(this.block),
                        headers: {
                            "content-type": "application/json"
                        }
                    })
                        .then(res => res.json())
                        .then(data => {
                            this.block.name = "";
                            alert("block Updated");
                            this.fetchBlocks();
                        })
                        .catch(err => console.log(err));
                }
            },
            editBlock(block) {
                this.edit = true;
                this.block.id = block.id;
                this.block.name = block.name;
                this.block.update_by = block.update_by;
            }
        }
    };
</script>