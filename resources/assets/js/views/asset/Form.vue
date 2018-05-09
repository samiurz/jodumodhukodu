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
                        <form @submit.prevent="addAsset" class="mb-3">
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label class="col-md-3 form-control-label" for="select">Select Company</label>
                                    <select id="select" type="select" class="form-control" v-model="asset.company_id">
                                        <option value="">Select Company</option>
                                        <option v-for="company in companies" v-bind:key="company.id" v-bind:value="company.id">{{company.name}}</option>
                                    </select>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label class="col-md-3 form-control-label" for="select">Select Model</label>
                                    <select id="select" type="select" class="form-control" v-model="asset.asset_id">
                                        <option value="">Select Model</option>
                                        <option v-for="assetmodel in assetmodels" v-bind:key="assetmodel.id" v-bind:value="assetmodel.id">{{assetmodel.name}}</option>
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
                                    <label for="customer">Cost</label>
                                     <input type="text" class="form-control" placeholder="Enter Cost" v-model="asset.cost">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-4">
                                    <label class="col-md-3 form-control-label" for="select">Manufacturer</label>
                                    <select id="select" type="select" class="form-control" v-model="asset.manufacturer_id">
                                        <option value="">Select Manufacturer</option>
                                        <option v-for="manufacturer in manufacturers" v-bind:key="manufacturer.id" v-bind:value="manufacturer.id">{{manufacturer.name}}</option>
                                    </select>
                                </div>
                                <div class="form-group col-sm-4">
                                     <label class="col-md-3 form-control-label" for="select">Status</label>
                                    <select id="select" type="select" class="form-control" v-model="asset.asset_location_id">
                                        <option value="">Select Location Status</option>
                                        <option v-for="assetLocation in assetLocations" v-bind:key="assetLocation.id" v-bind:value="assetLocation.id">{{assetLocation.location}}</option>
                                    </select>
                                </div>
                                <div class="form-group col-sm-4">
                                     <label class="col-md-3 form-control-label" for="select">Quality</label>
                                    <select id="select" type="select" class="form-control" v-model="asset.quality_id">
                                        <option value="">Select Quality</option>
                                        <option v-for="quality in qualities" v-bind:key="quality.id" v-bind:value="quality.id">{{quality.name}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label for="customer">Minimum Stock</label>
                                    <input type="text" class="form-control" placeholder="Minimum Stock" v-model="asset.minimum_stock">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="customer">Current Stock</label>
                                    <input type="text" class="form-control" placeholder="Current Stock" v-model="asset.current_stock">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label for="customer">Description</label>
                                    <textarea id="textarea-input" name="textarea-input" v-model="asset.description" rows="9" class="form-control" placeholder="Description.."></textarea>
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
                                <router-link :to="{ type: 'Asset List'}">
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
                manufacturers: [],
                qualities: [],
                assetmodels:[],
                assetLocations:[],
                asset: {
                    id: "",
                    company_id: "",
                    assets_model_id: "",
                    name:"",
                    serial: "",
                    label_id:"",
                    label_value:"",
                    description: "",
                    manufacturer_id:"",
                    quality_id:"",
                    cost:"",
                    asset_location_id:"",
                    image:"",
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
            this.fetchManufacturar();
            this.fetchAssetModel();
            this.fetchQuality();
            this.fetchAssetLocation();
            if (this.$route.params.data != undefined)
                this.editAsset(this.$route.params.data);
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
            fetchAssetLocation(page_url) {
                let vm = this;
                page_url = page_url || "/api/assetLocations";
                fetch(page_url)
                    .then(res => res.json())
                    .then(res => {
                        this.assetLocations = res.data;
                        console.log(this.assetLocations);
                    })
                    .catch(err => console.log(err));
            },
            fetchQuality(page_url) {
                let vm = this;
                page_url = page_url || "/api/qualities";
                fetch(page_url)
                    .then(res => res.json())
                    .then(res => {
                        this.qualities = res.data;
                        console.log(this.qualities);
                    })
                    .catch(err => console.log(err));
            },
            fetchAssetModel(page_url) {
                let vm = this;
                page_url = page_url || "/api/assetmodels";
                fetch(page_url)
                    .then(res => res.json())
                    .then(res => {
                        this.assetmodels = res.data;
                        console.log(this.assetmodels);
                    })
                    .catch(err => console.log(err));
            },
            addAsset() {
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
                            this.asset.manufacturer_id = "";
                            this.asset.quality_id = "";
                            this.asset.asset_location_id = "";
                            this.asset.minimum_stock = "";
                            this.asset.current_stock = "";
                            this.asset.comments = "";
                            this.asset.update_by = "";
                            alert("Asset Added");
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
                            this.asset.manufacturer_id = "";
                            this.asset.quality_id = "";
                            this.asset.asset_location_id = "";
                            this.asset.minimum_stock = "";
                            this.asset.current_stock = "";
                            this.asset.comments = "";
                            this.asset.update_by = "";
                            alert("documentation type Updated");
                            this.$router.push("/asset/list");
                        })
                        .catch(err => console.log(err));
                }
            },
            editAsset(asset) {
                this.edit = true;
                this.asset.id = asset.id;
                this.asset.company_id = asset.company_id;
                this.asset.asset_id = asset.asset_id;
                this.asset.serial = asset.serial;
                this.asset.type = asset.type;
                this.asset.description = asset.description;
                this.asset.image = asset.image;
                this.asset.manufacturer_id = asset.manufacturer_id;
                this.asset.quality_id = asset.quality_id;
                this.asset.asset_location_id = asset.asset_location_id;
                this.asset.minimum_stock = asset.minimum_stock;
                this.asset.current_stock = asset.current_stock;
                this.asset.comments = asset.comments;
                this.asset.update_by = asset.update_by;
            }
        }
    };
</script>