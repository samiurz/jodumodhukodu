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
                        <form @submit.prevent="addLabelname" class="mb-3">
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label for="customer">Name</label>
                                    <input type="text" class="form-control" placeholder="Enter Block Name" v-model="labelname.name">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="customer">Description</label>
                                    <input type="text" class="form-control" placeholder="Enter Block Name" v-model="labelname.description">
                                </div>
                            </div>
                            <!--/.row-->
                            <div class="form-actions">
                                <button type="submit" class="btn btn-primary">Save changes</button>
                                <router-link :to="{ name: 'Label List'}">
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
        name: "labelname",
        data() {
            return {
                selectedblock: "",
                labelnames: [],
                labelname: {
                    id: "",
                    name: "",
                    description: "",
                    update_by: "1"
                },
                id: "",
                pagination: {},
                edit: false
            };
        },

        created() {
            if (this.$route.params.id != undefined)
                this.editLabelname(this.$route.params.id);
        },

        methods: {
            fetchLabelnames(page_url) {
                let vm = this;
                page_url = page_url || "/api/labelnames";
                fetch(page_url)
                    .then(res => res.json())
                    .then(res => {
                        this.labelnames = res.data;
                        console.log(this.labelnames);
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
            deleteLabelname(id) {
                if (confirm("Are You Sure?")) {
                    fetch(`api/labelname/${id}`, {
                        method: "delete"
                    })
                        .then(res => res.json())
                        .then(data => {
                            alert("Label Removed");
                            this.fetchLabelnames();
                        })
                        .catch(err => console.log(err));
                }
            },
            addLabelname() {
                if (this.edit === false) {
                    // Add
                    fetch("api/labelname", {
                        method: "post",
                        body: JSON.stringify(this.labelname),
                        headers: {
                            "content-type": "application/json"
                        }
                    })
                        .then(res => res.json())
                        .then(data => {
                            this.labelname.name = "";
                            this.labelname.description = "";
                            alert("Label Added");
                            this.$router.push('/label/list');
                        })
                        .catch(err => console.log(err));
                } else {
                    // Update
                    fetch("api/labelname", {
                        method: "put",
                        body: JSON.stringify(this.labelname),
                        headers: {
                            "content-type": "application/json"
                        }
                    })
                        .then(res => res.json())
                        .then(data => {
                            this.labelname.name = "";
                            alert("Label Updated");
                            this.$router.push('/label/list');
                        })
                        .catch(err => console.log(err));
                }
            },
            editLabelname(labelname) {
                this.edit = true;
                this.labelname.id = labelname.id;
                this.labelname.name = labelname.name;
                this.labelname.description = labelname.description;
                this.labelname.update_by = labelname.update_by;
            }
        }
    };
</script>