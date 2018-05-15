<template>
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <strong>Block Status</strong>
                        <small>Form</small>
                        <router-link :to="{ name: 'Block Status Form'}">
                            <button class="btn btn-warning">Add</button>
                        </router-link>
                    </div>
                    <div class="card-block">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Comments</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="blockStat in blockStats" v-bind:key="blockStat.id">
                                    <td>{{ blockStat.name }}</td>
                                    <td>{{ blockStat.comments }}</td>
                                    <td>                                        
                                        <router-link :to="{ name: 'Block Status Form', params: { data: blockStat }}">
                                            <button class="btn btn-warning mb-2">Edit</button>
                                        </router-link>
                                    </td>
                                    <td>
                                        <button @click="deleteBlockStat(blockStat.id)" class="btn btn-danger">Delete</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <ul class="pagination">
                            <li v-bind:class="[{disabled: !pagination.prev_page_url}]" class="page-item">
                                <a class="page-link" href="#" @click="fetchBlockStats(pagination.prev_page_url)">Previous</a>
                            </li>

                            <li class="page-item disabled">
                                <a class="page-link text-dark" href="#">Page {{ pagination.current_page }} of {{ pagination.last_page }}</a>
                            </li>

                            <li v-bind:class="[{disabled: !pagination.next_page_url}]" class="page-item">
                                <a class="page-link" href="#" @click="fetchBlockStats(pagination.next_page_url)">Next</a>
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
        name: "blockStat",
        data() {
            return {
                blockStats: [],
                blockStat: {
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
            this.fetchBlockStats();
        },

        methods: {
            fetchBlockStats(page_url) {
                let vm = this;
                page_url = page_url || "/api/blockStats";
                fetch(page_url)
                    .then(res => res.json())
                    .then(res => {
                        this.blockStats = res.data;
                        console.log(this.blockStats);
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
            deleteBlockStat(id) {
                if (confirm("Are You Sure?")) {
                    fetch(`api/blockStat/${id}`, {
                        method: "delete"
                    })
                        .then(res => res.json())
                        .then(data => {
                            alert("Model Type Removed");
                            this.fetchBlockStats();
                        })
                        .catch(err => console.log(err));
                }
            }
        }
    };
</script>