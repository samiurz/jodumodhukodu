<template>
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <strong>module</strong>
                        <small>Form</small>
                    </div>
                    <div class="card-block">
                        <form @submit.prevent="addModule" class="mb-3">
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label class="col-md-3 form-control-label" for="select">Blocks</label>
                                    <select id="select" type="select" class="form-control" v-model="module.block_id">
                                        <option value="">Select Block</option>
                                        <option v-for="block in blocks" v-bind:key="block.id" v-bind:value="block.id">{{block.name}}</option>
                                    </select>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="module">module</label>
                                    <input type="text" class="form-control" v-model="module.name" placeholder="module">
                                </div>
                            </div>
                            <div class="row">
                                  <div class="form-group col-sm-12">
                                    <label for="country">Comments</label>
                                    <textarea id="comments" type="textarea-input" rows="9" class="form-control" v-model="module.comments" placeholder="Comments.."></textarea>
                                </div>
                            </div>
                            <div class="form-actions">
                                <button type="submit" class="btn btn-primary">Save changes</button>
                                <router-link :to="{ type: 'module List'}">
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
        type: "module",
        data() {
            return {
                blocks: [],
                module: {
                    id: "",
                    block_id: "",
                    name: "",
                    comments:"",
                    update_by: "1"
                },
                id: "",
                pagination: {},
                edit: false
            };
        },
        created() {
            console.log(this.$route.params.data);
            this.fetchBlocks();
            if (this.$route.params.data != undefined)
                this.editmodule(this.$route.params.data);
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
            addModule() {
                if (this.edit === false) {
                    // Add
                    fetch("api/module", {
                        method: "post",
                        body: JSON.stringify(this.module),
                        headers: {
                            "content-type": "application/json"
                        }
                    })
                        .then(res => res.json())
                        .then(data => {
                            this.module.id = "";
                            this.module.block_id = "";
                            this.module.name = "";
                            this.module.comments = "";
                            this.module.update_by = "";
                            alert("module Added");
                            this.$router.push("/module/list");
                        })
                        .catch(err => console.log(err));
                } else {
                    // Update
                    fetch("api/module", {
                        method: "put",
                        body: JSON.stringify(this.module),
                        headers: {
                            "content-type": "application/json"
                        }
                    })
                        .then(res => res.json())
                        .then(data => {
                            this.module.name = "";
                            this.module.comments = "";
                            alert("module Updated");
                            this.$router.push("/module/list");
                        })
                        .catch(err => console.log(err));
                }
            },
            editmodule(module) {
                this.edit = true;
                this.module.id = module.id;
                this.module.block_id = module.block_id;
                this.module.name = module.name;
                this.module.comments = module.comments;
                this.module.update_by = module.update_by;
            }
        }
    };
</script>