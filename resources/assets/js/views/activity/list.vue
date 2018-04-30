<template>
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <strong>LIST</strong>
                        <small>Form</small>
                        <router-link :to="{ name: 'Activity Form'}">
                            <button class="btn btn-warning">Add</button>
                        </router-link>
                    </div>
                    <div class="card-block">
                        <div class="card">
                            <table class="table" v-for="activity in activities" v-bind:key="activity.id">
                                <thead>
                                    <tr>
                                        <th>name</th>
                                        <th>comments</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ activity.name }}</td>
                                        <td>{{ activity.comments }}</td>
                                        <td>
                                            <button class="btn btn-warning mb-2">
                                                <router-link :to="{ name: 'Activity Form', params: { id: activity }}">Edit</router-link>
                                            </button>
                                        </td>
                                        <td>
                                            <button @click="deleteActivity(activity.id)" class="btn btn-danger">Delete</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <ul class="pagination">
                                <li v-bind:class="[{disabled: !pagination.prev_page_url}]" class="page-item">
                                    <a class="page-link" href="#" @click="fetchactivities(pagination.prev_page_url)">Previous</a>
                                </li>

                                <li class="page-item disabled">
                                    <a class="page-link text-dark" href="#">Page {{ pagination.current_page }} of {{ pagination.last_page }}</a>
                                </li>

                                <li v-bind:class="[{disabled: !pagination.next_page_url}]" class="page-item">
                                    <a class="page-link" href="#" @click="fetchactivities(pagination.next_page_url)">Next</a>
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
                activities: [],
                activity: {
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
            this.fetchactivities();
        },
        methods: {
            fetchactivities(page_url) {
                let vm = this;
                page_url = page_url || "/api/activities";
                fetch(page_url)
                    .then(res => res.json())
                    .then(res => {
                        this.activities = res.data;
                        console.log(this.activities);
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
            deleteActivity(id) {
                if (confirm("Are You Sure?")) {
                    fetch(`api/activity/${id}`, {
                        method: "delete"
                    })
                        .then(res => res.json())
                        .then(data => {
                            alert("activity Removed");
                            this.fetchactivities();
                        })
                        .catch(err => console.log(err));
                }
            }
        }
    };
</script>