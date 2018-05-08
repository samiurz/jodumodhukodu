<template>
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <strong>Document</strong>
                        <small>Form</small>
                    </div>
                    <div class="card-block">
                        <form @submit.prevent="addDocument" class="mb-3">
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label class="col-md-3 form-control-label" for="select">Select Company</label>
                                    <select id="select" type="select" class="form-control" v-model="document.company_id">
                                        <option value="">Select Company</option>
                                        <option v-for="company in companies" v-bind:key="company.id" v-bind:value="company.id">{{company.name}}</option>
                                    </select>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label class="col-md-3 form-control-label" for="select">Select Asset</label>
                                    <select id="select" type="select" class="form-control" v-model="document.documentation_types_id">
                                        <option value="">Select Document Type</option>
                                        <option v-for="documentationType in documentationTypes" v-bind:key="documentationType.id" v-bind:value="documentationTypes.id">{{documentationTypes.name}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label for="customer">Url</label>
                                    <input type="text" class="form-control" placeholder="Enter Type" v-model="document.type">
                                </div>
                                <label class="col-md-3 form-control-label" for="file-input">File input</label>
                                <div class="col-md-9">
                                  <input type="file" id="file-input" name="file-input">
                                </div>
                            </div>
                            <div class="form-actions">
                                <button type="submit" class="btn btn-primary">Save changes</button>
                                <router-link :to="{ type: 'Document List'}">
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
        type: "document",
        data() {
            return {
                companies: [],
                documentationTypes: [],
                document: {
                    id: "",
                    company_id: "",
                    documentation_types_id: "",
                    file: "",
                    url: "",
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
            this.fetchDocumentationTypes();
            if (this.$route.params.data != undefined)
                this.editDocument(this.$route.params.data);
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
            fetchDocumentationTypes(page_url) {
                let vm = this;
                page_url = page_url || "/api/documentationTypes";
                fetch(page_url)
                    .then(res => res.json())
                    .then(res => {
                        this.documentationTypes = res.data;
                        console.log(this.documentationTypes);
                    })
                    .catch(err => console.log(err));
            },
            addDocument() {
                if (this.edit === false) {
                    // Add
                    fetch("api/document", {
                        method: "post",
                        body: JSON.stringify(this.document),
                        headers: {
                            "content-type": "application/json"
                        }
                    })
                        .then(res => res.json())
                        .then(data => {
                            this.document.id = "";
                            this.document.company_id = "";
                            this.document.documentation_types_id = "";
                            this.document.url = "";
                            this.document.file = "";
                            this.document.comments = "";
                            this.document.update_by = "";
                            alert("document Added");
                            this.$router.push("/document/list");
                        })
                        .catch(err => console.log(err));
                } else {
                    // Update
                    fetch("api/document", {
                        method: "put",
                        body: JSON.stringify(this.document),
                        headers: {
                            "content-type": "application/json"
                        }
                    })
                        .then(res => res.json())
                        .then(data => {
                            this.document.id = "";
                            this.document.company_id = "";
                            this.document.documentation_types_id = "";
                            this.document.url = "";
                            this.document.file = "";
                            this.document.comments = "";
                            alert("Document Updated");
                            this.$router.push("/document/list");
                        })
                        .catch(err => console.log(err));
                }
            },
            editDocument(document) {
                this.edit = true;
                this.document.id = document.id;
                this.document.company_id = document.company_id;
                this.document.document_type_id = document.document_type_id;
                this.document.url = document.url;
                this.document.file = document.file;
                this.document.comments = document.comments;
                this.document.update_by = document.update_by;
            }
        }
    };
</script>