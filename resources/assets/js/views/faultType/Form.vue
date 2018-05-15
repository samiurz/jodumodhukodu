<template>
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <strong> Fault Type</strong>
                        <small>Form</small>
                    </div>
                    <div class="card-block">
                        <form @submit.prevent="addFaultType" class="mb-3">
                            <div class="row">
                                <div class="form-group col-sm-4">
                                    <label class="col-md-3 form-control-label" for="select">companys</label>
                                    <select id="select" type="select" class="form-control" v-model="faultType.company_id">
                                        <option value="">Select a company</option>
                                        <option v-for="company in companies" v-bind:key="company.id" v-bind:value="company.id">{{company.name}}</option>
                                    </select>
                                </div>
                                <div class="form-group col-sm-4">
                                      <label class="col-md-3 form-control-label" for="select">Asset</label>
                                    <select id="select" type="select" class="form-control" v-model="faultType.asset_id">
                                        <option value="">Select a Asset</option>
                                        <option v-for="asset in assets" v-bind:key="asset.id" v-bind:value="asset.id">{{asset.name}}</option>
                                    </select>
                                </div>
                                <div class="form-group col-sm-4">
                                    <label for="type">Type</label>
                                    <input type="text" class="form-control" v-model="faultType.type" placeholder="Type">
                                </div>
                            </div>
                            <div class="row">
                                  <div class="form-group col-sm-12">
                                    <label for="country">Comments</label>
                                    <textarea id="comments" type="textarea-input" rows="9" class="form-control" v-model="faultType.comments" placeholder="Comments.."></textarea>
                                </div>
                            </div>
                            <div class="form-actions">
                                <button type="submit" class="btn btn-primary">Save changes</button>
                                <router-link :to="{ type: 'Fault Type List'}">
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
        type: "faultType",
        data() {
            return {
                selectedCompany: 1,
                companies: [],
                assets:[],
                faultType: {
                    id: "",
                    company_id: "",
                    asset_id: "",
                    type: "",
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
            console.log(this.$route.params.data);
            this.fetchCompanies();
            this.fetchAssets();
            if (this.$route.params.data != undefined)
                this.editFaultType(this.$route.params.data);
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
            fetchAssets(page_url) {
                let vm = this;
                page_url = page_url || "/api/assets";
                fetch(page_url)
                    .then(res => res.json())
                    .then(res => {
                        this.assets = res.data;
                        console.log(this.assets);
                    })
                    .catch(err => console.log(err));
            },
            addFaultType() {
                if (this.edit === false) {
                    // Add
                    fetch("api/faultType", {
                        method: "post",
                        body: JSON.stringify(this.faultType),
                        headers: {
                            "content-type": "application/json"
                        }
                    })
                        .then(res => res.json())
                        .then(data => {
                            this.faultType.id = "";
                            this.faultType.company_id = "";
                            this.faultType.asset_id = "";
                            this.faultType.type = "";
                            this.faultType.comments = "";
                            this.faultType.is_enabled = "";
                            this.faultType.created_by = "";
                            this.faultType.update_by = "";
                            alert("Fault type Added");
                            this.$router.push("/faultType/list");
                        })
                        .catch(err => console.log(err));
                } else {
                    // Update
                    fetch("api/faultType", {
                        method: "put",
                        body: JSON.stringify(this.faultType),
                        headers: {
                            "content-type": "application/json"
                        }
                    })
                        .then(res => res.json())
                        .then(data => {
                            this.faultType.type = "";
                            this.faultType.comments = "";
                            this.faultType.is_enabled = "";
                            this.faultType.created_by = "";
                            this.faultType.update_by = "";
                            alert("Fault type Updated");
                            this.$router.push("/faultType/list");
                        })
                        .catch(err => console.log(err));
                }
            },
            editFaultType(faultType) {
                this.edit = true;
                this.faultType.id = faultType.id;
                this.faultType.company_id = faultType.company_id;
                this.faultType.asset_id = faultType.asset_id;
                this.faultType.type = faultType.type;
                this.faultType.comments = faultType.comments;
                this.faultType.is_enabled = faultType.is_enabled;
                this.faultType.created_by = faultType.created_by;
                this.faultType.update_by = faultType.update_by;
            }
        }
    };
</script>