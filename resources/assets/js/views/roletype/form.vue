<template>
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <strong>Role Type</strong>
                        <small>Form</small>
                    </div>
                    <div class="card-block">
                        <form @submit.prevent="addroletype" class="mb-3">
                            <div class="row">
                                <div class="form-group col-sm-3">
                                    <label for="customer">Name</label>
                                    <input type="text" class="form-control" placeholder="Enter roletype Name" v-model="roletype.name">
                                </div>
                                <div class="form-group col-sm-9">
                                    <label for="customer">Comment</label>
                                    <textarea id="textarea-input" name="textarea-input" v-model="roletype.comments" rows="9" class="form-control" placeholder="Comments.."></textarea>
                                </div>
                            </div>
                            <!--/.row-->
                            <div class="form-actions">
                                <button type="submit" class="btn btn-primary">Save changes</button>
                                <router-link :to="{ name: 'Role Type List'}">
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
                roletypes: [],
                roletype: {
                    id: "",
                    name: "",
                    comments: "",
                    update_by: "1"
                },
                id: "",
                pagination: {},
                edit: false
            };
        },

        created() {
            if (this.$route.params.id != undefined)
                this.editroletype(this.$route.params.id);
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
            },
            addroletype() {
                if (this.edit === false) {
                    // Add
                    fetch("api/roletype", {
                        method: "post",
                        body: JSON.stringify(this.roletype),
                        headers: {
                            "content-type": "application/json"
                        }
                    })
                        .then(res => res.json())
                        .then(data => {
                            this.roletype.name = "";
                            this.roletype.comments = "";
                            alert("roletype Added");
                            this.$router.push('/roletype/list');
                        })
                        .catch(err => console.log(err));
                } else {
                    // Update
                    fetch("api/roletype", {
                        method: "put",
                        body: JSON.stringify(this.roletype),
                        headers: {
                            "content-type": "application/json"
                        }
                    })
                        .then(res => res.json())
                        .then(data => {
                            this.roletype.name = "";
                            alert("roletype Updated");
                            this.$router.push('/roletype/list');
                        })
                        .catch(err => console.log(err));
                }
            },
            editroletype(roletype) {
                this.edit = true;
                this.roletype.id = roletype.id;
                this.roletype.name = roletype.name;
                this.roletype.comments = roletype.comments;
                this.roletype.update_by = roletype.update_by;
            }
        }
    };
</script>