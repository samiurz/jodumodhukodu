<template>
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <strong>Label</strong>
                        <small>Form</small>
                        <router-link :to="{ name: 'Label Form'}">
                            <button class="btn btn-warning">Add</button>
                        </router-link>
                    </div>
                    <div class="card-block">
                            <div class="card">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>name</th>
                                            <th>description</th>
                                            <th>Edit</th>
                                            <th>Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="labelname in labelnames" v-bind:key="labelname.id">
                                            <td>{{ labelname.name }}</td>
                                            <td>{{ labelname.description }}</td>
                                            <td>
                                                    <router-link :to="{ name: 'Label Form', params: { id: labelname }}">
                                                        <button  class="btn btn-warning mb-2">Edit</button>
                                                    </router-link>
                                            </td>
                                            <td> <button @click="deleteLabelname(labelname.id)" class="btn btn-danger">Delete</button></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <ul class="pagination">
                                    <li v-bind:class="[{disabled: !pagination.prev_page_url}]" class="page-item">
                                        <a class="page-link" href="#" @click="fetchLabelnames(pagination.prev_page_url)">Previous</a>
                                    </li>
            
                                    <li class="page-item disabled">
                                        <a class="page-link text-dark" href="#">Page {{ pagination.current_page }} of {{ pagination.last_page }}</a>
                                    </li>
            
                                    <li v-bind:class="[{disabled: !pagination.next_page_url}]" class="page-item">
                                        <a class="page-link" href="#" @click="fetchLabelnames(pagination.next_page_url)">Next</a>
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
        name: "label",
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
            this.fetchLabelnames();
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
                            this.block.name = "";
                            alert("Label Added");
                            this.$router.push('/labelname/list');
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
                            this.block.name = "";
                            alert("Label Updated");
                            this.$router.push('/labelname/list');
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