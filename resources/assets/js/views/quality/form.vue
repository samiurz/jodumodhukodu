<template>
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <strong>Quality</strong>
                        <small>Form</small>
                    </div>
                    <div class="card-block">
                        <form @submit.prevent="addQuality" class="mb-3">
                            <div class="row">
                                <div class="form-group col-sm-3">
                                    <label for="customer">Name</label>
                                    <input type="text" class="form-control" placeholder="Enter Quality Name" v-model="quality.name">
                                </div>
                                <div class="form-group col-sm-9">
                                    <label for="customer">Comment</label>
                                    <textarea id="textarea-input" name="textarea-input" v-model="quality.comments" rows="9" class="form-control" placeholder="Comments.."></textarea>
                                </div>
                            </div>
                            <!--/.row-->
                            <div class="form-actions">
                                <button type="submit" class="btn btn-primary">Save changes</button>
                                <router-link :to="{ name: 'Quality List'}">
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
                quality: {
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
                this.editQuality(this.$route.params.id);
        },

        methods: {
            addQuality() {
                if (this.edit === false) {
                    // Add
                    fetch("api/quality", {
                        method: "post",
                        body: JSON.stringify(this.quality),
                        headers: {
                            "content-type": "application/json"
                        }
                    })
                        .then(res => res.json())
                        .then(data => {
                            this.quality.name = "";
                            this.quality.comments = "";
                            this.quality.is_enabled = "";
                            this.quality.created_by = "";
                            this.quality.update_by = "";;
                            alert("quality Added");
                            this.$router.push('/quality/list');
                        })
                        .catch(err => console.log(err));
                } else {
                    // Update
                    fetch("api/quality", {
                        method: "put",
                        body: JSON.stringify(this.quality),
                        headers: {
                            "content-type": "application/json"
                        }
                    })
                        .then(res => res.json())
                        .then(data => {
                            this.quality.name = "";
                            this.quality.comments = "";
                            this.quality.is_enabled = "";
                            this.quality.created_by = "";
                            this.quality.update_by = "";
                            alert("quality Updated");
                            this.$router.push('/quality/list');
                        })
                        .catch(err => console.log(err));
                }
            },
            editQuality(quality) {
                this.edit = true;
                this.quality.id = quality.id;
                this.quality.name = quality.name;
                this.quality.comments = quality.comments;
                this.quality.is_enabled = quality.is_enabled;
                this.quality.created_by = quality.created_by;
                this.quality.update_by = quality.update_by;
            }
        }
    };
</script>