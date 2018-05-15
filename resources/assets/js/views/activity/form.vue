<template>
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <strong>Activity</strong>
                        <small>Form</small>
                    </div>
                    <div class="card-block">
                        <form @submit.prevent="addactivity" class="mb-3">
                            <div class="row">
                                <div class="form-group col-sm-3">
                                    <label for="customer">Name</label>
                                    <input type="text" class="form-control" placeholder="Enter activity Name" v-model="activity.name">
                                </div>
                                <div class="form-group col-sm-9">
                                    <label for="customer">Comment</label>
                                    <textarea id="textarea-input" name="textarea-input" v-model="activity.comments" rows="9" class="form-control" placeholder="Comments.."></textarea>
                                </div>
                            </div>
                            <!--/.row-->
                            <div class="form-actions">
                                <button type="submit" class="btn btn-primary">Save changes</button>
                                <router-link :to="{ name: 'Activity List'}">
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
                activities: [],
                activity: {
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
                this.editactivity(this.$route.params.id);
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
            deleteactivity(id) {
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
            },
            addactivity() {
                if (this.edit === false) {
                    // Add
                    fetch("api/activity", {
                        method: "post",
                        body: JSON.stringify(this.activity),
                        headers: {
                            "content-type": "application/json"
                        }
                    })
                        .then(res => res.json())
                        .then(data => {
                            this.activity.name = "";
                            this.activity.comments = "";
                            this.activity.is_enabled = "";
                            this.activity.created_by = "";
                            this.activity.update_by = "";
                            alert("activity Added");
                            this.$router.push('/activity/list');
                        })
                        .catch(err => console.log(err));
                } else {
                    // Update
                    fetch("api/activity", {
                        method: "put",
                        body: JSON.stringify(this.activity),
                        headers: {
                            "content-type": "application/json"
                        }
                    })
                        .then(res => res.json())
                        .then(data => {
                            this.activity.name = "";
                            alert("activity Updated");
                            this.$router.push('/activity/list');
                        })
                        .catch(err => console.log(err));
                }
            },
            editactivity(activity) {
                this.edit = true;
                this.activity.id = activity.id;
                this.activity.name = activity.name;
                this.activity.comments = activity.comments;
                this.activity.is_enabled = activity.is_enabled;
                this.activity.created_by = activity.created_by;
                this.activity.update_by = activity.update_by;
            }
        }
    };
</script>