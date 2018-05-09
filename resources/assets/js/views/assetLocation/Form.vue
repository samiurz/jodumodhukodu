<template>
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <strong>Asset Location Status</strong>
                        <small>Form</small>
                    </div>
                    <div class="card-block">
                        <form @submit.prevent="addAssetLocation" class="mb-3">
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label class="col-md-3 form-control-label" for="select">companys</label>
                                    <select id="select" type="select" class="form-control" v-model="assetLocation.company_id">
                                        <option value="">Select a company</option>
                                        <option v-for="company in companies" v-bind:key="company.id" v-bind:value="company.id">{{company.name}}</option>
                                    </select>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="">Location</label>
                                    <input type="text" class="form-control" v-model="assetLocation.location" placeholder="In Warehouse">
                                </div>
                            </div>
                            <div class="row">
                                  <div class="form-group col-sm-12">
                                    <label for="country">Comments</label>
                                    <textarea id="comments" type="textarea-input" rows="9" class="form-control" v-model="assetLocation.comments" placeholder="Comments.."></textarea>
                                </div>
                            </div>
                            <div class="form-actions">
                                <button type="submit" class="btn btn-primary">Save changes</button>
                                <router-link :to="{ type: 'Asset Location List'}">
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
        type: "assetLocation",
        data() {
            return {
                companies: [],
                assetLocation: {
                    id: "",
                    company_id: "",
                    location: "",
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
            this.fetchCompanies();
            if (this.$route.params.data != undefined)
                this.editAssetLocation(this.$route.params.data);
        },
        methods: {
            fetchCompanies(page_url) {
                let vm = this;
                page_url = page_url || "/api/companies";
                fetch(page_url)
                    .then(res => res.json())
                    .then(res => {
                        this.companies = res.data;
                        console.log(this.companies);
                    })
                    .catch(err => console.log(err));
            },
            addAssetLocation() {
                if (this.edit === false) {
                    // Add
                    fetch("api/assetLocation", {
                        method: "post",
                        body: JSON.stringify(this.assetLocation),
                        headers: {
                            "content-type": "application/json"
                        }
                    })
                        .then(res => res.json())
                        .then(data => {
                            this.assetLocation.id = "";
                            this.assetLocation.company_id = "";
                            this.assetLocation.location = "";
                            this.assetLocation.comments = "";
                            this.assetLocation.update_by = "";
                            alert("Asset Location Status Added");
                            this.$router.push("/assetLocation/list");
                        })
                        .catch(err => console.log(err));
                } else {
                    // Update
                    fetch("api/assetLocation", {
                        method: "put",
                        body: JSON.stringify(this.assetLocation),
                        headers: {
                            "content-type": "application/json"
                        }
                    })
                        .then(res => res.json())
                        .then(data => {
                            this.assetLocation.location = "";
                            this.assetLocation.comments = "";
                            alert("Asset Location Status Updated");
                            this.$router.push("/assetLocation/list");
                        })
                        .catch(err => console.log(err));
                }
            },
            editAssetLocation(assetLocation) {
                this.edit = true;
                this.assetLocation.id = assetLocation.id;
                this.assetLocation.company_id = assetLocation.company_id;
                this.assetLocation.location = assetLocation.location;
                this.assetLocation.comments = assetLocation.comments;
                this.assetLocation.update_by = assetLocation.update_by;
            }
        }
    };
</script>