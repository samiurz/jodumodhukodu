<template>
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <strong>Quality</strong>
                        <small>Form</small>
                        <router-link :to="{ name: 'Quality Form'}">
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
                                    <tr v-for="quality in qualities" v-bind:key="quality.id">
                                        <td>{{ quality.name }}</td>
                                        <td>{{ quality.comments }}</td>
                                        <td>
                                                <router-link :to="{ name: 'Quality Form', params: { id: quality }}">
                                                     <button class="btn btn-warning mb-2">Edit</button>
                                                </router-link>
                                        </td>
                                        <td>
                                            <button @click="deleteQuality(quality.id)" class="btn btn-danger">Delete</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <ul class="pagination">
                                <li v-bind:class="[{disabled: !pagination.prev_page_url}]" class="page-item">
                                    <a class="page-link" href="#" @click="fetchQualities(pagination.prev_page_url)">Previous</a>
                                </li>

                                <li class="page-item disabled">
                                    <a class="page-link text-dark" href="#">Page {{ pagination.current_page }} of {{ pagination.last_page }}</a>
                                </li>

                                <li v-bind:class="[{disabled: !pagination.next_page_url}]" class="page-item">
                                    <a class="page-link" href="#" @click="fetchQualities(pagination.next_page_url)">Next</a>
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
        name: "quality",
        data() {
            return {
                qualities: [],
                quality: {
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
            this.fetchQualities();
        },
        methods: {
            fetchQualities(page_url) {
                let vm = this;
                page_url = page_url || "/api/qualities";
                fetch(page_url)
                    .then(res => res.json())
                    .then(res => {
                        this.qualities = res.data;
                        console.log(this.qualities);
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
            deleteQuality(id) {
                if (confirm("Are You Sure?")) {
                    fetch(`api/quality/${id}`, {
                        method: "delete"
                    })
                        .then(res => res.json())
                        .then(data => {
                            alert("quality Removed");
                            this.fetchQualities();
                        })
                        .catch(err => console.log(err));
                }
            }
        }
    };
</script>