<template>
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-sm-12">
                <div class="card card-inverse card-info">
                    <div class="card-header">
                        <strong>Asset Model</strong>
                        <small>Form</small>
                    </div>
                    <div class="card-block">
                        <form @submit.prevent="addAttachment" class="mb-3">
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label class="col-md-3 form-control-label" for="select">Select Company</label>
                                    <select id="select" type="select" class="form-control" v-model="assetModel.company_id">
                                        <option value="">Select Company</option>
                                        <option v-for="company in companies" v-bind:key="company.id" v-bind:value="company.id">{{company.name}}</option>
                                    </select>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label class="col-md-3 form-control-label" for="select">Select Model Type</label>
                                    <select id="select" type="select" class="form-control" v-model="assetModel.model_type_id">
                                        <option value="">Select Model Type</option>
                                         <option v-for="modelType in modelTypes" v-bind:key="modelType.id" v-bind:value="modelType.id">{{modelType.type}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-4">
                                    <label for="customer">Model Name</label>
                                    <input type="text" class="form-control" placeholder="Enter asset model Name" v-model="assetModel.name">
                                </div>
                                <div class="form-group col-sm-4">
                                    <label for="customer">Rent</label>
                                    <input type="text" class="form-control" placeholder="Enter rent" v-model="assetModel.rent">
                                </div>
                                <div class="form-group col-sm-4">
                                    <label for="customer">frequency</label>
                                    <input type="text" class="form-control" placeholder="Enter frequency" v-model="assetModel.frequency">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label for="customer">Minimum Stock</label>
                                    <input type="text" class="form-control" placeholder="Minimum Stock" v-model="assetModel.minimum_stock">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="customer">Current Stock</label>
                                    <input type="text" class="form-control" placeholder="Current Stock" v-model="assetModel.current_stock">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-12">
                                    <label for="customer">Comments</label>
                                    <textarea id="textarea-input" name="textarea-input" v-model="assetModel.comments" rows="9" class="form-control" placeholder="Comments.."></textarea>
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
                                <router-link :to="{ type: 'Asset Model List'}">
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
        type: "asset model",
        data() {
            return {
                companies: [],
                modelTypes:[],
                assetModel: {
                    id: "",
                    company_id: "",
                    model_type_id: "",
                    name:"",
                    image: "",
                    rent:"",
                    frequency:"",
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
            this.fetchModelTypes();
            if (this.$route.params.data != undefined)
                this.editAssetModel(this.$route.params.data);

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
            fetchModelTypes(page_url) {
                let vm = this;
                page_url = page_url || "/api/modelTypes";
                fetch(page_url)
                    .then(res => res.json())
                    .then(res => {
                        this.modelTypes = res.data;
                        console.log(this.modelTypes);
                    })
                    .catch(err => console.log(err));
            },
            addAssetModel() {
                //this.submit()

                if(this.assetModel.image)
                {
                    if (this.edit === false) {
                        // Add
                        fetch("api/assetModel", {
                            method: "post",
                            body: JSON.stringify(this.assetModel),
                            headers: {
                                "content-type": "application/json"
                            }
                        })
                        .then(res => res.json())
                        .then(data => {
                            this.assetModel.id = "";
                            this.assetModel.company_id = "";
                            this.assetModel.model_type_id = "";
                            this.assetModel.name = "";
                            this.assetModel.image = "";
                            this.assetModel.rent = "";
                            this.assetModel.frequency = "";
                            this.assetModel.minimum_stock = "";
                            this.assetModel.current_stock = "";
                            this.assetModel.comments = "";
                            this.assetModel.created_by = "";
                            this.assetModel.update_by = "";
                            alert("Model Type Added");
                            this.$router.push("/assetModel/list");
                        })
                        .catch(err => console.log(err));
                    } 
                    
                    else {
                        // Update
                        fetch("api/assetModel", {
                            method: "put",
                            body: JSON.stringify(this.assetModel),
                            headers: {
                                "content-type": "application/json"
                            }
                        })
                        .then(res => res.json())
                        .then(data => {
                            this.assetModel.id = "";
                            this.assetModel.company_id = "";
                            this.assetModel.model_type_id = "";
                            this.assetModel.name = "";
                            this.assetModel.image = "";
                            this.assetModel.rent = "";
                            this.assetModel.frequency = "";
                            this.assetModel.minimum_stock = "";
                            this.assetModel.current_stock = "";
                            this.assetModel.comments = "";
                            this.assetModel.created_by = "";
                            this.assetModel.update_by = "";
                            alert("Model Type Updated");
                            this.$router.push("/assetModel/list");
                        })
                        .catch(err => console.log(err));
                    }
                }
            },
            editAssetModel(assetModel) {
                this.edit = true;
                this.assetModel.id = assetModel.id;
                this.assetModel.company_id = assetModel.company_id;
                this.assetModel.model_type_id = assetModel.model_type_id;
                this.assetModel.name = assetModel.name;
                this.assetModel.image = assetModel.image;
                this.assetModel.rent = assetModel.rent;
                this.assetModel.minimum_stock = assetModel.minimum_stock;
                this.assetModel.current_stock = assetModel.current_stock;
                this.assetModel.comments = assetModel.comments;
                this.assetModel.update_by = assetModel.update_by;
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
                        this.assetModel.image = response.data.data
                        this.addAssetModel()
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