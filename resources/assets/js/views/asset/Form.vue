<template>
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-sm-12">
                <div class="card card-inverse card-info">
                    <div class="card-header">
                        <strong>Asset</strong>
                        <small>Form</small>
                    </div>
                    <div class="card-block">
                        <form @submit.prevent="addAttachment" class="mb-3">
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
                                    <select id="select" type="select" class="form-control" v-model="asset.assets_model_id">
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
                                <div class="col-md-12">
                                    <!-- <div class="form-group">
                                        <div class="form-group files">
                                            <div class="attachment-holder animated fadeIn" v-cloak v-for="(attachment, index) in attachments"> 
                                                <div class="form-group">
                                                    <span class="label label-primary"><a target="_blank" class="link" :href="attachment.path">{{ attachment.name + ' (' + Number((attachment.size / 1024 / 1024).toFixed(1)) + 'MB)'}}</a></span> 
                                                    <span class="label label-warning" >{{ attachment.time }}</span>
                                                    <span class="" style="background: red; cursor: pointer;" @click="removeAttachments(attachment)"><button class="btn btn-xs btn-danger">Remove</button></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div> -->
                                    <!-- <input type="file" id="file-input" name="file-input"> -->
                                    <input type="file" multiple="multiple" id="attachments" @change="uploadFieldChange">
                                    <hr>
                                    <div class="form-group files">
                                        <div class="attachment-holder animated fadeIn" v-cloak v-for="(attachment, index) in attachments"> 
                                            <div class="form-group">
                                                <span class="label label-primary">{{ attachment.name + ' (' + Number((attachment.size / 1024 / 1024).toFixed(1)) + 'MB)'}}</span> 
                                                <span style="background: red; cursor: pointer;" @click="removeAttachment(attachment)"><button class="btn btn-xs btn-danger">Remove</button></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions">
                                <button type="submit" class="btn btn-default">Save changes</button>
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
                    asset_model_id: "",
                    name:"",
                    serial: "",
                    label_id:"",
                    label_value:"",
                    description: "",
                    quality_id: "",
                    manufacturer_id:"",
                    cost:"",
                    asset_location_id:"",
                    image:"",
                    minimum_stock:"",
                    current_stock:"",
                    comments:"",
                    is_enabled: "1",
                    created_by: "1",
                    update_by: "1",
                },
                id: "",
                edit: false,
                attachments: [],
                attachment_labels: [],
                categories: [],
                data: new FormData(),
                percentCompleted: 0,
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
                this.editasset(this.$route.params.data);

            this.start();

            // window.Event.listen('reload_files', function() {
            //     console.log('Received Reload Files Event!');
            //     this.pullAttachments(); // Pull attachments again
            // }.bind(this));
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
                //this.submit()

                if(this.asset.image)
                {
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
                    } 
                    
                    else {
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
            },
            selectCategory(attachment, category_id) {
                attachment.category_id = category_id;
                console.log(attachment);
                this.$forceUpdate();
            },

            validate() {
                if (!this.attachments.length) {
                    //toastr.warning('Please add files', 'Warning');
                    return false;
                } 
                return true;
            },

            getAttachmentSize() {
                this.upload_size = 0; // Reset to beginningƒ
                this.attachments.map((item) => { this.upload_size += parseInt(item.size); });
                this.upload_size = Number((this.upload_size).toFixed(1));
                this.$forceUpdate();
            },

            prepareFields() {

                for (var i = this.attachments.length - 1; i >= 0; i--) {
                    console.log(this.attachments[i].category_id);
                    this.data.append("attachments[][0]", this.attachments[i]);
                    this.data.append("attachments[][1]", this.attachments[i].category_id);
                }

                for (var i = this.attachment_labels.length - 1; i >= 0; i--) {
                    this.data.append("attachment_labels[]", JSON.stringify(this.attachment_labels[i]));
                }

            },

            removeAttachment(attachment) {
                this.attachments.splice(this.attachments.indexOf(attachment), 1);
                this.getAttachmentSize();
            },

            // This function will be called every time you add a file
            uploadFieldChange(e) {
                var files = e.target.files || e.dataTransfer.files;
                if (!files.length)
                    return;

                for (var i = files.length - 1; i >= 0; i--) {
                    this.attachments.push(files[i]);
                }

                // Reset the form to avoid copying these files multiple times into this.attachments
                document.getElementById("attachments").value = [];
                console.log(attachments);
            },

            addAttachment() {
                this.prepareFields();
                if (!this.validate()) {
                    return false;
                }

                //window.Event.fire('loading_on');
                var config = {
                    headers: { 'Content-Type': 'multipart/form-data' } ,
                    onUploadProgress: function(progressEvent) {
                        this.percentCompleted = Math.round( (progressEvent.loaded * 100) / progressEvent.total );
                        //window.Event.fire('percent', this.percentCompleted);
                        console.log(this.percentCompleted);
                        this.$forceUpdate();
                    }.bind(this)
                };

                //Make HTTP request to store announcement
                axios.post('/api/attachments/store', this.data, config)
                .then(function (response) {
                    console.log(response);
                    if (response.data.success) {
                        console.log('Successfull upload');
                        this.asset.image = response.data.data
                        this.addAsset()
                        this.resetData()
                        
                        // Tell AttachmentList component to refresh its list
                    } else {
                        //toastr.error('Somethind went wrong', 'Error');
                        console.log('Unsuccessful Upload');
                    }
                   
                }
                .bind(this)) // Make sure we bind Vue Component object to this funtion so we get a handle of it in order to call its other methods
                .catch(function (error) {
                    console.log(error);
                    
                });

                console.log(attachments)
            },

            // We want to clear the FormData object on every upload so we can re-calculate new files again.
            // Keep in mind that we can delete files as well so in the future we will need to keep track of that as well
            resetData() {
                this.data = new FormData(); // Reset it completely
                this.attachments = [];
            },

            removeServerAttachment(attachment_id){

                window.Event.fire('loading_on');
                let data = {
                    params: 
                    {
                        attachment_id: attachment_id
                    }
                };

                // Make HTTP request to store announcement
                axios.delete('/attachments', data)
                .then(function (response) {
                    console.log(response);
                    if (response.data.success) {
                        toastr.success('File deleted!', 'Success');
                        this.getAttachmentSize();
                    } else {
                        console.log(response.data.errors);
                        toastr.error('Something went wront', 'Error');
                    }
                    
                }.bind(this)) // Make sure we bind Vue Component object to this funtion so we get a handle of it in order to call its other methods
                .catch(function (error) {
                    console.log(error);
                    
                });
                
            },

            pullAttachments() {

                //window.Event.fire('loading_on');

                // Make HTTP request to store announcement
                axios.post('/api/attachments').then(function (response) {
                    console.log(response);
                    if (response.data.success) {
                        this.attachments = response.data.data;
                        console.log('Attachments: ', this.attachments);
                        toastr.success('We just pulled all the attachments', 'Background Task: Success');
                        this.getAttachmentSize();
                    } else {
                        console.log(response.data.errors);
                        toastr.warning('Cannot pull attachments. User has to be logged in', 'Background Task: Warning');
                    }
                    
                }.bind(this)) // Make sure we bind Vue Component object to this funtion so we get a handle of it in order to call its other methods
                .catch(function (error) {
                    console.log(error);
                    
                });

            },

            getAttachmentSize() {

                this.upload_size = 0; // Reset to beginningƒ

                this.attachments.map((item) => { this.upload_size += parseInt(item.size); });
                
                this.upload_size = Number((this.upload_size).toFixed(1));

                this.$forceUpdate();

            },

            removeAttachments(attachment) {

                this.removeServerAttachment(attachment.id);

                this.attachments.splice(this.attachments.indexOf(attachment), 1);
                
                this.getAttachmentSize();

            },

            start() {
                console.log('Starting Attachment List Component');
                this.pullAttachments();
            },
        }
    };
</script>