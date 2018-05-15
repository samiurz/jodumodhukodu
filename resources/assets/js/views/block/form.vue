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
                                <div class="form-group col-sm-3">
                                    <label for="customer">Name</label>
                                    <input type="text" class="form-control" placeholder="Enter Block Name" v-model="block.name">
                                </div>
                                <div class="form-group col-sm-9">
                                    <label for="customer">Comment</label>
                                    <textarea id="textarea-input" name="textarea-input" v-model="block.comments" rows="9" class="form-control" placeholder="Content.."></textarea>
                                </div>
                            </div>
                            <!--/.row-->
                            <div class="form-actions">
                                <button type="submit" class="btn btn-primary">Save changes</button>
                                <router-link :to="{ name: 'Block List'}">
                                    <button type="button" class="btn btn-default">Cancel</button>
                                </router-link>
                            </div>
                        </form>
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
                    comments: "",
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
            if (this.$route.params.id != undefined)
                this.editBlock(this.$route.params.id);
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
                            this.block.comments = "";
                            this.block.is_enabled = "";
                            this.block.comments = "";
                            this.block.created_by = "";
                            this.block.update_by = "";
                            alert("block Added");
                            this.$router.push('/block/list');
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
                            this.$router.push('/block/list');
                        })
                        .catch(err => console.log(err));
                }
            },
            editBlock(block) {
                this.edit = true;
                this.block.id = block.id;
                this.block.name = block.name;
                this.block.comments = block.comments;
                this.block.is_enabled = block.is_enabled;
                this.block.created_by = block.created_by;
                this.block.update_by = block.update_by;
            }
        }
    };
</script>