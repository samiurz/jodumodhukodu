<template>
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <strong> Job</strong>
                        <small>Form</small>
                    </div>
                    <div class="card-block">
                        
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" id="myTab" v-on:click="select($event)" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="job-tab" data-toggle="tab" href="#job" role="tab" aria-controls="home" aria-selected="true">Job Allocation</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="repair-tab" data-toggle="tab" href="#repair" role="tab" aria-controls="profile" aria-selected="false">Repair Order</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="jobsheet-tab" data-toggle="tab" href="#jobsheet" role="tab" aria-controls="messages" aria-selected="false">Job Sheet</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="close-tab" data-toggle="tab" href="#close" role="tab" aria-controls="settings" aria-selected="false">Job Closeout</a>
                            </li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div class="tab-pane active" id="job" role="tabpanel" aria-labelledby="job-tab">
                                <form @submit.prevent="addJob" class="mb-3">
                                    <div class="row">
                                        <div class="form-group col-sm-6">
                                            <label class="col-md-3 form-control-label" for="select">Job</label>
                                            <select id="select" type="select" class="form-control">
                                                <option value="">Select Job Type</option>
                                                <option v-for="jobType in jobTypes" v-bind:key="jobType.id" v-bind:value="jobType.id">{{jobType.type}}</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <label class="col-md-3 form-control-label" for="select">Priority</label>
                                            <select id="select" type="select" class="form-control" v-model="job.jobPriority_id">
                                                <option value="">Select Priority</option>
                                                <option v-for="jobPriority in jobPriorities" v-bind:key="jobPriority.id" v-bind:value="jobPriority.id">{{jobPriority.priority}}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-sm-6">
                                            <label for="jobraised">Date Raised</label>
                                            <input type="date" class="form-control" v-model="job.date_raised" placeholder="">
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <label for="joballocated">Date Allocated</label>
                                            <input type="date" class="form-control" v-model="job.date_allocated" placeholder="">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-sm-6">
                                            <label class="col-md-3 form-control-label" for="select">Select Contractor</label>
                                            <select id="select" type="select" class="form-control" v-model="job.company_id">
                                                <option value="">Select Contractor</option>
                                                <option v-for="company in companies" v-bind:key="company.id" v-bind:value="company.id">{{company.name}}</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <label class="col-md-3 form-control-label" for="select">Select Technicial</label>
                                            <select id="select" type="select" class="form-control" v-model="job.contact_id">
                                                <option value="">Select Technician</option>
                                                <option v-for="contact in contacts" v-bind:key="contact.id" v-bind:value="contact.id">{{contact.name}}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-sm-6">
                                            <label for="country">Job Description</label>
                                            <textarea id="description" type="textarea-input" rows="9" class="form-control" v-model="job.description" placeholder="Description.."></textarea>
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <label for="country">Comments</label>
                                            <textarea id="comments" type="textarea-input" rows="9" class="form-control" v-model="job.comments" placeholder="Comments.."></textarea>
                                        </div>
                                    </div>
                                    <div class="form-actions">
                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                        <router-link :to="{ type: 'Job List'}">
                                            <button type="button" class="btn btn-default">Cancel</button>
                                        </router-link>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane" id="repair" role="tabpanel" aria-labelledby="repair-tab">
                                <form @submit.prevent="addJob" class="mb-3">
                                    <div class="row">
                                        <div class="form-group col-sm-4">
                                            <label class="col-md-3 form-control-label" for="select">Company</label>
                                            <select id="select" type="select" class="form-control"  v-model="job.company_id" @change="companySelected()">
                                                <option value="">Select Company</option>
                                                <option v-for="company in companies" v-bind:key="company.id" v-bind:value="company.id">{{company.name}}</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-sm-4">
                                            <label class="col-md-3 form-control-label" for="select">Contact</label>
                                            <select id="select" type="select" class="form-control"  v-model="job.contact_id" @change="contactSelected()">
                                                <option value="">Select Contact</option>
                                                <option v-for="contact in contacts" v-bind:key="contact.id" v-bind:value="contact.id">{{contact.name}}</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-sm-4">
                                            <label for="jobraised">Phone</label>
                                            <input type="text" class="form-control" v-model="selectedContact.phone" disabled placeholder="">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-sm-12">
                                            <label for="jobraised">Address</label>
                                            <input type="text" class="form-control" v-model="selectedCompany.address" disabled placeholder="">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-sm-3">
                                            <label class="col-md-3 form-control-label" for="select">Assets</label>
                                            <select id="select" type="select" class="form-control" v-model="job.asset_id" @change="assetsSelected()" >
                                                <option value="">Select Asset</option>
                                                <option v-for="asset in assets" v-bind:key="asset.id" v-bind:value="asset.id">{{asset.name}}</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-sm-3">
                                            <label for="jobraised">Serial</label>
                                            <input type="text" class="form-control" v-model="selectedAsset.serial" disabled placeholder="">
                                        </div>
                                        <div class="form-group col-sm-3">
                                            <label for="joballocated">BMB No</label>
                                            <input type="text" class="form-control" v-model="selectedAsset.label_value" disabled placeholder="">
                                        </div>
                                        <div class="form-group col-sm-3">
                                            <label for="joballocated">Installed In</label>
                                            <input type="text" class="form-control" disabled placeholder="">
                                        </div>
                                    </div>  
                                    <div class="row">
                                        <div class="form-group col-sm-6">
                                            <label for="country">Fault Description</label>
                                            <textarea id="description" type="textarea-input" rows="2" class="form-control" placeholder="Description.."></textarea>
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <label class="col-md-3 form-control-label" for="select">Select Repair Type</label>
                                            <select id="select" type="select" class="form-control" v-model="job.repairType_id">
                                                <option value="">Repair Type</option>
                                                <option v-for="repairType in repairTypes" v-bind:key="repairType.id" v-bind:value="repairType.id">{{repairType.type}}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-sm-3">
                                            <label class="col-md-3 form-control-label" for="select">Spares</label>
                                            <select id="select" type="select" class="form-control" v-model="job.spare_id" @change="sparesSelected()">
                                                <option value="">Spare</option>
                                                <option v-for="spare in spares" v-bind:key="spare.id" v-bind:value="spare.id">{{spare.name}}</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-sm-3">
                                            <label for="joballocated">Quantity</label>
                                            <input type="text" class="form-control" v-model="selectedSpare.current_stock" placeholder="">
                                        </div>
                                        <div class="form-group col-sm-3">
                                            <label for="joballocated">Price</label>
                                            <input type="text" class="form-control" v-model="selectedSpare.cost" disabled placeholder="">
                                        </div>
                                        <div class="form-group col-sm-3">
                                            <label for="joballocated">Total</label>
                                            <input type="text" class="form-control" disabled placeholder="">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-sm-12">
                                            <label for="country">Comments</label>
                                            <textarea id="comments" type="textarea-input" rows="9" class="form-control" v-model="job.comments" placeholder="Comments.."></textarea>
                                        </div>
                                    </div>
                                    <div class="form-actions">
                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                        <router-link :to="{ type: 'Job List'}">
                                            <button type="button" class="btn btn-default">Cancel</button>
                                        </router-link>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane" id="jobsheet" role="tabpanel" aria-labelledby="jobsheet-tab">
                                <form @submit.prevent="addJob" class="mb-3">
                                    <div class="row">
                                        <div class="form-group col-sm-4">
                                            <label for="jobraised">Name</label>
                                            <input type="text" class="form-control" disabled placeholder="Ganz">
                                        </div>
                                        <div class="form-group col-sm-4">
                                            <label for="jobraised">SWMC DOC No</label>
                                            <input type="text" class="form-control" disabled placeholder="Hazard Indentification No">
                                        </div>
                                        <div class="form-group col-sm-4">
                                            <label for="jobraised">Signature</label>
                                            <input type="text" class="form-control" disabled placeholder="Use from profile">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-sm-6">
                                            <label for="jobraised">Repair Order No</label>
                                            <input type="text" class="form-control" disabled placeholder="012934">
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <label for="jobraised">Contractor</label>
                                            <input type="text" class="form-control" disabled placeholder="JLE">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-sm-3">
                                            <label for="jobraised">Date</label>
                                            <input type="date" class="form-control" placeholder="">
                                        </div>
                                        <div class="form-group col-sm-3">
                                            <label for="jobraised">Time In</label>
                                            <input type="date" class="form-control" placeholder="">
                                        </div>
                                        <div class="form-group col-sm-3">
                                            <label for="jobraised">Time Out</label>
                                            <input type="date" class="form-control" placeholder="">
                                        </div>
                                        <div class="form-group col-sm-3">
                                            <label for="jobraised">On Site</label>
                                            <input type="date" class="form-control" placeholder="">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-sm-3">
                                            <label for="jobraised">Travel Hours</label>
                                            <input type="text" class="form-control" placeholder="">
                                        </div>
                                        <div class="form-group col-sm-3">
                                            <label for="jobraised">Total KM</label>
                                            <input type="text" class="form-control" placeholder="">
                                        </div>
                                        <div class="form-group col-sm-3">
                                            <label for="jobraised"> Waiting Time </label>
                                            <input type="text" class="form-control" placeholder="">
                                        </div>
                                        <div class="form-group col-sm-3">
                                            <label for="jobraised">Reason for Wait</label>
                                            <input type="text" class="form-control" placeholder="Contact, Parts">
                                        </div>
                                        <p>Add Another Trip Information</p>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-sm-12">
                                            <label for="country">Technicial Comments</label>
                                            <textarea id="description" type="textarea-input" rows="2" class="form-control" placeholder="Description.."></textarea>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-sm-3">
                                            <label for="jobraised">Total Cup Count</label>
                                            <input type="number" class="form-control" placeholder="">
                                        </div>
                                        <div class="form-group col-sm-9">
                                            <label class="col-md-3 form-control-label">Job Checklist</label>
                                            <div class="col-md-9">
                                                <label class="checkbox-inline" for="inline-checkbox1">
                                                    <input type="checkbox" id="inline-checkbox1" name="inline-checkbox1" value="option1">Run & Flush
                                                </label>
                                                <label class="checkbox-inline" for="inline-checkbox2">
                                                    <input type="checkbox" id="inline-checkbox2" name="inline-checkbox2" value="option2">Insulation Test Completed
                                                </label>
                                                <label class="checkbox-inline" for="inline-checkbox3">
                                                    <input type="checkbox" id="inline-checkbox3" name="inline-checkbox3" value="option3">Work Area Tied
                                                </label>
                                                <label class="checkbox-inline" for="inline-checkbox3">
                                                    <input type="checkbox" id="inline-checkbox3" name="inline-checkbox3" value="option3">Product Checked
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group col-sm-12">
                                            <label class="col-md-3 form-control-label" for="file-multiple-input">Upload Asset Files</label>
                                            <div class="col-md-9">
                                                <input type="file" id="file-multiple-input" name="file-multiple-input" multiple>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-sm-6">
                                            <label for="country">Customer Signature</label>
                                            <textarea id="comments" type="textarea-input" rows="9" class="form-control" v-model="job.comments" placeholder=""></textarea>
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <label for="country">Comments</label>
                                            <textarea id="comments" type="textarea-input" rows="9" class="form-control" v-model="job.comments" placeholder="Comments.."></textarea>
                                        </div>
                                    </div>
                                    <div class="form-actions">
                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                        <router-link :to="{ type: 'Job List'}">
                                            <button type="button" class="btn btn-default">Cancel</button>
                                        </router-link>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane" id="close" role="tabpanel" aria-labelledby="close-tab">
                                <form @submit.prevent="addJob" class="mb-3">
                                    <div class="row">
                                        <div class="form-group col-sm-6">
                                            <label class="col-md-6 form-control-label" for="select">Authorized Person</label>
                                            <select id="select" type="select" class="form-control">
                                                <option value="">Select Authorized Person</option>
                                                <option v-for="jobType in jobTypes" v-bind:key="jobType.id" v-bind:value="jobType.id">{{jobType.type}}</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <label class="col-md-3 form-control-label" for="select">Job Quality</label>
                                            <select id="select" type="select" class="form-control" v-model="job.jobPriority_id">
                                                <option value="">Select Priority</option>
                                                <option v-for="jobPriority in jobPriorities" v-bind:key="jobPriority.id" v-bind:value="jobPriority.id">{{jobPriority.priority}}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-sm-12">
                                            <label for="country">Comment</label>
                                            <textarea id="description" type="textarea-input" rows="9" class="form-control" v-model="job.description" placeholder="Description.."></textarea>
                                        </div>
                                    </div>
                                    <div class="form-actions">
                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                        <button type="submit" class="btn btn-warning">Send Email To Contractor</button>
                                        <router-link :to="{ type: 'Job List'}">
                                            <button type="button" class="btn btn-default">Cancel</button>
                                        </router-link>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/.col-->
</template>
<script>
    export default {
        type: "documenttype",
        data() {
            return {
                companies: [],
                jobTypes: [],
                contacts: [],
                jobPriorities: [],
                assets:[],
                spares:[],
                repairTypes:[],
                job: {
                    id: "",
                    company_id: "",
                    jobType_id: "",
                    jobPriority_id: "",
                    date_allocated: "",
                    date_raised: "",
                    contact_id: "",
                    description: "",
                    comments: "",
                    update_by: "1"
                },
                id: "",
                pagination: {},
                edit: false,
                selectedCompany: {},
                selectedContact:{},
                selectedAsset:{},
                selectedSpare:{}
            };
        },
        created() {
            console.log(this.$route.params.data);
            this.fetchCompanies();
            this.fetchJobTypes();
            this.fetchJobPriorities();
            this.fetchContacts();
            this.fetchAssets();
            this.fetchSpares();
            this.fetchRepairTypes();
            if (this.$route.params.data != undefined)
                this.editjob(this.$route.params.data);
            // $('#myTab a').on('click', function (e) {
            //     e.preventDefault()
            //     $(this).tab('show')
            // })
            // $('#myTab a').click(function (e) {
            //     if ($(this).parent('li').hasClass('active')) {
            //         $($(this).attr('href')).hide();
            //     }
            //     else {
            //         e.preventDefault();
            //         $(this).tab('show');
            //     }
            // });
            $('#myTab a[href="#repair"]').tab('show') // Select tab by name
            $('#myTab li:first-child a').tab('hide') // Select first tab
            $('#myTab li:last-child a').tab('show') // Select last tab
            $('#myTab li:nth-child(3) a').tab('show') // Select third tab
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
            fetchJobTypes(page_url) {
                let vm = this;
                page_url = page_url || "/api/jobTypes";
                fetch(page_url)
                    .then(res => res.json())
                    .then(res => {
                        this.jobTypes = res.data;
                        console.log(this.jobTypes);
                    })
                    .catch(err => console.log(err));
            },
            fetchContacts(page_url) {
                let vm = this;
                page_url = page_url || "/api/contacts";
                fetch(page_url)
                    .then(res => res.json())
                    .then(res => {
                        this.contacts = res.data;
                        console.log(this.contacts);
                    })
                    .catch(err => console.log(err));
            },
            fetchContactsByCompanyId(page_url) {
                let vm = this;
                page_url = page_url || `api/contacts/company/${vm.selectedCompany.id}`;
                fetch(page_url)
                    .then(res => res.json())
                    .then(res => {
                        this.contacts = res.data;
                        console.log(this.contacts);
                    })
                    .catch(err => console.log(err));
            },
            fetchJobPriorities(page_url) {
                let vm = this;
                page_url = page_url || "/api/jobPriorities";
                fetch(page_url)
                    .then(res => res.json())
                    .then(res => {
                        this.jobPriorities = res.data;
                        console.log(this.jobPriorities);
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
            fetchSpares(page_url) {
                let vm = this;
                page_url = page_url || "/api/spares";
                fetch(page_url)
                    .then(res => res.json())
                    .then(res => {
                        this.spares = res.data;
                        console.log(this.spares);
                    })
                    .catch(err => console.log(err));
            },
            fetchRepairTypes(page_url) {
                let vm = this;
                page_url = page_url || "/api/repairTypes";
                fetch(page_url)
                    .then(res => res.json())
                    .then(res => {
                        this.repairTypes = res.data;
                        console.log(this.repairTypes);
                    })
                    .catch(err => console.log(err));
            },
            addJob() {
                if (this.edit === false) {
                    // Add
                    fetch("api/job", {
                        method: "post",
                        body: JSON.stringify(this.job),
                        headers: {
                            "content-type": "application/json"
                        }
                    })
                        .then(res => res.json())
                        .then(data => {
                            this.job.id = "";
                            this.job.company_id = "";
                            this.job.priority = "";
                            this.job.comments = "";
                            this.job.update_by = "";
                            alert("Job type Added");
                            this.$router.push("/job/list");
                        })
                        .catch(err => console.log(err));
                } else {
                    // Update
                    fetch("api/job", {
                        method: "put",
                        body: JSON.stringify(this.job),
                        headers: {
                            "content-type": "application/json"
                        }
                    })
                        .then(res => res.json())
                        .then(data => {
                            this.job.company_id = "";
                            this.job.priority = "";
                            this.job.comments = "";
                            alert("Job type Updated");
                            this.$router.push("/job/list");
                        })
                        .catch(err => console.log(err));
                }
            },
            editjob(job) {
                this.edit = true;
                this.job.id = job.id;
                this.job.company_id = job.company_id;
                this.job.type = job.priority;
                this.job.comments = job.comments;
                this.job.update_by = job.update_by;
            },
            select: function(event) {
                //targetId = event.currentTarget.id;
                console.log(event); // returns 'foo'

                if ($(this).parent('li').hasClass('active')) {
                    $($(this).attr('href')).hide();
                }
                else {
                    event.preventDefault();
                    $(this).tab('show');
                }
            },
            companySelected() {
                let ref = this
                ref.companies.forEach( company => {
                    if(company.id === ref.job.company_id){
                        console.log(company)
                        ref.selectedCompany = company
                    }
                });

                if('id' in ref.selectedCompany){
                    ref.fetchContactsByCompanyId()
                }
            },
            contactSelected(){
                let ref = this
                ref.contacts.forEach( contact => {
                    if(contact.id === ref.job.contact_id){
                        console.log(contact)
                        ref.selectedContact = contact
                    }
                });
            },
            assetsSelected(){
                let ref = this
                ref.assets.forEach( asset => {
                    if(asset.id === ref.job.asset_id){
                        console.log(asset)
                        ref.selectedAsset = asset
                    }
                });
            },
            sparesSelected(){
                let ref = this
                ref.spares.forEach( spare => {
                    if(spare.id === ref.job.spare_id){
                        console.log(spare)
                        ref.selectedSpare = spare
                    }
                });
            }
        }
    };
</script>