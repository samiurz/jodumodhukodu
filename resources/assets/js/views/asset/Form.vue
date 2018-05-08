<template>
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <strong>Asset</strong>
                        <small>Form</small>
                    </div>
                    <div class="card-block">
                        <form @submit.prevent="addasset" class="mb-3">
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label class="col-md-3 form-control-label" for="select">Select Company</label>
                                    <select id="select" type="select" class="form-control" v-model="asset.company_id">
                                        <option value="">Select Company</option>
                                        <option v-for="company in companies" v-bind:key="company.id" v-bind:value="company.id">{{company.name}}</option>
                                    </select>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label class="col-md-3 form-control-label" for="select">Select Asset</label>
                                    <select id="select" type="select" class="form-control" v-model="asset.asset_id">
                                        <option value="">Select Model</option>
                                        <option v-for="asset in assets" v-bind:key="asset.id" v-bind:value="asset.id">{{asset.name}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-3">
                                    <label for="customer">Asset Name</label>
                                    <input type="text" class="form-control" placeholder="Enter Asset Name" v-model="asset.name">
                                </div>
                                <div class="form-group col-sm-3">
                                    <label for="customer">Serial</label>
                                    <input type="text" class="form-control" placeholder="Enter Serial" v-model="asset.serial">
                                </div>
                                <div class="form-group col-sm-3">
                                    <label for="customer">BMB No</label>
                                    <input type="text" class="form-control" placeholder="Enter BMB No" v-model="asset.label_value">
                                </div>
                                <div class="form-group col-sm-3">
                                    <label for="customer">type</label>
                                    <input type="text" class="form-control" placeholder="Enter Type" v-model="asset.type">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-3">
                                    <label class="col-md-3 form-control-label" for="select">Quality</label>
                                    <select id="select" type="select" class="form-control" v-model="asset.manufacturar_id">
                                        <option value="">Select Quality</option>
                                        <option v-for="manufacturer in manufacturers" v-bind:key="manufacturer.id" v-bind:value="manufacturer.id">{{manufacturer.name}}</option>
                                    </select>
                                </div>
                                <div class="form-group col-sm-3">
                                    <label for="customer">Status</label>
                                    <input type="text" class="form-control" placeholder="Enter status" v-model="asset.status">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="customer">Cost</label>
                                     <input type="text" class="form-control" placeholder="Enter Cost" v-model="asset.cost">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-3">
                                    <label for="customer">Minimum Stock</label>
                                    <input type="text" class="form-control" placeholder="Minimum Stock" v-model="asset.minimum_stock">
                                </div>
                                <div class="form-group col-sm-3">
                                    <label for="customer">Current Stock</label>
                                    <input type="text" class="form-control" placeholder="Current Stock" v-model="asset.current_stock">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="customer">Comments</label>
                                    <textarea id="textarea-input" name="textarea-input" v-model="asset.comments" rows="9" class="form-control" placeholder="Comments.."></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-md-3 form-control-label" for="file-input">File input</label>
                                <div class="col-md-9">
                                  <input type="file" id="file-input" name="file-input">
                                </div>
                              </div>
                            <div class="form-actions">
                                <button type="submit" class="btn btn-primary">Save changes</button>
                                <router-link :to="{ type: 'asset List'}">
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
        type: "asset",
        data() {
            return {
                companies: [],
                assets: [],
                manufacturers: [],
                asset: {
                    id: "",
                    company_id: "",
                    asset_id: "",
                    serial: "",
                    type: "",
                    description: "",
                    image:"",
                    manufacturar_id:"",
                    minimum_stock:"",
                    current_stock:"",
                    comments:"",
                    update_by: "1"
                },
                id: "",
                edit: false
            };
        },
        created() {
            console.log(this.$route.params.data);
            this.fetchCompanies();
            this.fetchAssets();
            this.fetchManufacturar();
            if (this.$route.params.data != undefined)
                this.editasset(this.$route.params.data);
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
            fetchManufacturar(page_url) {
                let vm = this;
                page_url = page_url || "/api/manufacturers";
                fetch(page_url)
                    .then(res => res.json())
                    .then(res => {
                        this.manufacturers = res.data;
                        console.log(this.manufacturers);
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
            addasset() {
                if (this.edit === false) {
                    // Add
                    fetch("api/asset", {
                        method: "post",
                        body: JSON.stringify(this.asset),
                        headers: {
                            "content-type": "application/json"
                        }
                    })
                        .then(res => res.json())
                        .then(data => {
                            this.asset.id = "";
                            this.asset.company_id = "";
                            this.asset.asset_id = "";
                            this.asset.serial = "";
                            this.asset.type = "";
                            this.asset.description = "";
                            this.asset.image = "";
                            this.asset.manufacturar_id = "";
                            this.asset.minimum_stock = "";
                            this.asset.current_stock = "";
                            this.asset.comments = "";
                            this.asset.update_by = "";
                            alert("asset Added");
                            this.$router.push("/asset/list");
                        })
                        .catch(err => console.log(err));
                } else {
                    // Update
                    fetch("api/asset", {
                        method: "put",
                        body: JSON.stringify(this.asset),
                        headers: {
                            "content-type": "application/json"
                        }
                    })
                        .then(res => res.json())
                        .then(data => {
                            this.asset.id = "";
                            this.asset.company_id = "";
                            this.asset.asset_id = "";
                            this.asset.serial = "";
                            this.asset.type = "";
                            this.asset.description = "";
                            this.asset.image = "";
                            this.asset.manufacturar_id = "";
                            this.asset.minimum_stock = "";
                            this.asset.current_stock = "";
                            this.asset.comments = "";
                            alert("documentation type Updated");
                            this.$router.push("/asset/list");
                        })
                        .catch(err => console.log(err));
                }
            },
            editasset(asset) {
                this.edit = true;
                this.asset.id = asset.id;
                this.asset.company_id = asset.company_id;
                this.asset.asset_id = asset.asset_id;
                this.asset.serial = asset.serial;
                this.asset.type = asset.type;
                this.asset.description = asset.description;
                this.asset.image = asset.image;
                this.asset.manufacturar_id = asset.manufacturar_id;
                this.asset.minimum_stock = asset.minimum_stock;
                this.asset.current_stock = asset.current_stock;
                this.asset.comments = asset.comments;
                this.asset.update_by = asset.update_by;
            }
        }
    };
</script>