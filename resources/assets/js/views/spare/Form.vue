<template>
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-sm-12">
                <div class="card ">
                    <div class="card-header">
                        <strong>Spare</strong>
                        <small>Form</small>
                    </div>
                    <div class="card-block">
                        <form @submit.prevent="addSpare" class="mb-3">
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label class="col-md-3 form-control-label" for="select">Select Company</label>
                                    <select id="select" type="select" class="form-control" v-model="spare.company_id">
                                        <option value="">Select Company</option>
                                        <option v-for="company in companies" v-bind:key="company.id" v-bind:value="company.id">{{company.name}}</option>
                                    </select>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label class="col-md-3 form-control-label" for="select">Select Asset</label>
                                    <select id="select" type="select" class="form-control" v-model="spare.asset_id">
                                        <option value="">Select Asset</option>
                                        <option v-for="asset in assets" v-bind:key="asset.id" v-bind:value="asset.id">{{asset.name}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label class="col-md-3 form-control-label" for="select">Manufacturer</label>
                                    <select id="select" type="select" class="form-control" v-model="spare.manufacturar_id">
                                        <option value="">Select Manufacturer</option>
                                        <option v-for="manufacturer in manufacturers" v-bind:key="manufacturer.id" v-bind:value="manufacturer.id">{{manufacturer.name}}</option>
                                    </select>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="customer">Serial</label>
                                    <input type="text" class="form-control" placeholder="Enter Serial" v-model="spare.serial">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-4">
                                    <label for="customer">Cost</label>
                                    <input type="text" class="form-control" placeholder="Enter Cost" v-model="spare.cost">
                                </div>
                                <div class="form-group col-sm-4">
                                    <label for="customer">Minimum Stock</label>
                                    <input type="text" class="form-control" placeholder="Minimum Stock" v-model="spare.minimum_stock">
                                </div>
                                <div class="form-group col-sm-4">
                                    <label for="customer">Current Stock</label>
                                    <input type="text" class="form-control" placeholder="Current Stock" v-model="spare.current_stock">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label for="customer">Description</label>
                                    <textarea id="textarea-input" name="textarea-input" v-model="spare.description" rows="9" class="form-control" placeholder="Description.."></textarea>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="customer">Comments</label>
                                    <textarea id="textarea-input" name="textarea-input" v-model="spare.comments" rows="9" class="form-control" placeholder="Comments.."></textarea>
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
                                <router-link :to="{ type: 'Spare List'}">
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
        type: "spare",
        data() {
            return {
                companies: [],
                assets: [],
                manufacturers: [],
                spare: {
                    id: "",
                    company_id: "",
                    asset_id: "",
                    name:"",
                    serial: "",
                    cost: "",
                    description: "",
                    image: "",
                    manufacturar_id: "",
                    minimum_stock: "",
                    current_stock: "",
                    comments: "",
                    is_enabled:"0",
                    created_by:"1",
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
                this.editSpare(this.$route.params.data);
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
            addSpare() {
                if (this.edit === false) {
                    // Add
                    fetch("api/spare", {
                        method: "post",
                        body: JSON.stringify(this.spare),
                        headers: {
                            "content-type": "application/json"
                        }
                    })
                        .then(res => res.json())
                        .then(data => {
                            this.spare.id = "";
                            this.spare.company_id = "";
                            this.spare.asset_id = "";
                            this.spare.name = "";
                            this.spare.serial = "";
                            this.spare.cost = "";
                            this.spare.description = "";
                            this.spare.image = "";
                            this.spare.manufacturar_id = "";
                            this.spare.minimum_stock = "";
                            this.spare.current_stock = "";
                            this.spare.comments = "";
                            this.spare.is_enabled = "";
                            this.spare.created_by = "";
                            this.spare.update_by = "";
                            alert("Spare Added");
                            this.$router.push("/spare/list");
                        })
                        .catch(err => console.log(err));
                } else {
                    // Update
                    fetch("api/spare", {
                        method: "put",
                        body: JSON.stringify(this.spare),
                        headers: {
                            "content-type": "application/json"
                        }
                    })
                        .then(res => res.json())
                        .then(data => {
                            this.spare.company_id = "";
                            this.spare.asset_id = "";
                            this.spare.name = "";
                            this.spare.serial = "";
                            this.spare.cost = "";
                            this.spare.description = "";
                            this.spare.image = "";
                            this.spare.manufacturar_id = "";
                            this.spare.minimum_stock = "";
                            this.spare.current_stock = "";
                            this.spare.comments = "";
                             this.spare.is_enabled = "";
                            this.spare.created_by = "";
                            this.spare.update_by = "";
                            alert("Spare Updated");
                            this.$router.push("/spare/list");
                        })
                        .catch(err => console.log(err));
                }
            },
            editSpare(spare) {
                this.edit = true;
                this.spare.id = spare.id;
                this.spare.company_id = spare.company_id;
                this.spare.asset_id = spare.asset_id;
                this.spare.name = spare.name;
                this.spare.serial = spare.serial;
                this.spare.cost = spare.cost;
                this.spare.description = spare.description;
                this.spare.image = spare.image;
                this.spare.manufacturar_id = spare.manufacturar_id;
                this.spare.minimum_stock = spare.minimum_stock;
                this.spare.current_stock = spare.current_stock;
                this.spare.comments = spare.comments;
                this.spare.is_enabled = spare.is_enabled;
                this.spare.created_by = spare.created_by;
                this.spare.update_by = spare.update_by;
            }
        }
    };
</script>