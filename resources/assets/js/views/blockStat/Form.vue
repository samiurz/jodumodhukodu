<template>
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <strong>Block Status</strong>
                        <small>Form</small>
                    </div>
                    <div class="card-block">
                        <form @submit.prevent="addBlockStat" class="mb-3">
                            <div class="row">
                                <div class="form-group col-sm-12">
                                    <label for="blockStat">Name</label>
                                    <input type="text" class="form-control" v-model="blockStat.name" placeholder="Block Status">
                                </div>
                            </div>
                            <div class="row">
                                  <div class="form-group col-sm-12">
                                    <label for="country">Comments</label>
                                    <textarea id="comments" type="textarea-input" rows="9" class="form-control" v-model="blockStat.comments" placeholder="Comments.."></textarea>
                                </div>
                            </div>
                            <div class="form-actions">
                                <button type="submit" class="btn btn-primary">Save changes</button>
                                <router-link :to="{ type: 'Block Status List'}">
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
        type: "blockStat",
        data() {
            return {
                blockStat: {
                    id: "",
                    name: "",
                    comments:"",
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
            if (this.$route.params.data != undefined)
                this.editBlockStat(this.$route.params.data);
        },
        methods: {
            addBlockStat() {
                if (this.edit === false) {
                    // Add
                    fetch("api/blockStat", {
                        method: "post",
                        body: JSON.stringify(this.blockStat),
                        headers: {
                            "content-type": "application/json"
                        }
                    })
                        .then(res => res.json())
                        .then(data => {
                            this.blockStat.id = "";
                            this.blockStat.name = "";
                            this.blockStat.comments = "";
                            this.blockStat.is_enabled = "";
                            this.blockStat.created_by = "";
                            this.blockStat.update_by = "";
                            alert("Block Status Added");
                            this.$router.push("/blockStat/list");
                        })
                        .catch(err => console.log(err));
                } else {
                    // Update
                    fetch("api/blockStat", {
                        method: "put",
                        body: JSON.stringify(this.blockStat),
                        headers: {
                            "content-type": "application/json"
                        }
                    })
                        .then(res => res.json())
                        .then(data => {
                            this.blockStat.name = "";
                            this.blockStat.comments = "";
                            this.blockStat.is_enabled = "";
                            this.blockStat.created_by = "";
                            this.blockStat.update_by = "";
                            alert("Block Status Updated");
                            this.$router.push("/blockStat/list");
                        })
                        .catch(err => console.log(err));
                }
            },
            editBlockStat(blockStat) {
                this.edit = true;
                this.blockStat.id = blockStat.id;
                this.blockStat.name = blockStat.name;
                this.blockStat.comments = blockStat.comments;
                this.blockStat.is_enabled = blockStat.is_enabled;
                this.blockStat.created_by = blockStat.created_by;
                this.blockStat.update_by = blockStat.update_by;
            }
        }
    };
</script>