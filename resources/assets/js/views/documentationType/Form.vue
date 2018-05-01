<template>
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <strong>Document Type</strong>
                        <small>Form</small>
                    </div>
                    <div class="card-block">
                        <form @submit.prevent="addDocumentationType" class="mb-3">
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label class="col-md-3 form-control-label" for="select">companys</label>
                                    <select id="select" type="select" class="form-control" v-model="documentationType.company_id">
                                        <option value="">Select a company</option>
                                        <option v-for="company in companies" v-bind:key="company.id" v-bind:value="company.id">{{company.name}}</option>
                                    </select>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="documentationType">Type</label>
                                    <input type="text" class="form-control" v-model="documentationType.type" placeholder="pdf">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label class="col-md-3 form-control-label" for="select">Blocks</label>
                                    <select id="select" type="select" class="form-control" v-model="documentationType.block_id">
                                        <option value="">Select a Block</option>
                                        <option v-for="block in blocks" v-bind:key="block.id" v-bind:value="block.id">{{block.name}}</option>
                                    </select>
                                </div>
                                  <div class="form-group col-sm-6">
                                    <label for="country">Comments</label>
                                    <textarea id="comments" type="textarea-input" rows="9" class="form-control" v-model="documentationType.comments" placeholder="Comments.."></textarea>
                                </div>
                            </div>
                            <div class="form-actions">
                                <button type="submit" class="btn btn-primary">Save changes</button>
                                <router-link :to="{ type: 'Documentation Type List'}">
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
        type: "documenttype",
        data() {
            return {
                selectedCompany: 1,
                documentationTypes: [],
                blocks:[],
                companies: [],
                documentationType: {
                    id: "",
                    company_id: "",
                    type: "",
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
            this.fetchBlocks();
            if (this.$route.params.data != undefined)
                this.editdocumentationType(this.$route.params.data);
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
            fetchBlocks(page_url) {
                let vm = this;
                page_url = page_url || "/api/blocks";
                fetch(page_url)
                    .then(res => res.json())
                    .then(res => {
                        this.blocks = res.data;
                        console.log(this.blocks);
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
            addDocumentationType() {
                if (this.edit === false) {
                    // Add
                    fetch("api/documentationType", {
                        method: "post",
                        body: JSON.stringify(this.documentationType),
                        headers: {
                            "content-type": "application/json"
                        }
                    })
                        .then(res => res.json())
                        .then(data => {
                            this.documentationType.id = "";
                            this.documentationType.company_id = "";
                            this.documentationType.type = "";
                            this.documentationType.comments = "";
                            this.documentationType.update_by = "";
                            alert("documentation type Added");
                            this.$router.push("/documentationType/list");
                        })
                        .catch(err => console.log(err));
                } else {
                    // Update
                    fetch("api/documentationType", {
                        method: "put",
                        body: JSON.stringify(this.documentationType),
                        headers: {
                            "content-type": "application/json"
                        }
                    })
                        .then(res => res.json())
                        .then(data => {
                            this.documentationType.type = "";
                            this.documentationType.comments = "";
                            alert("documentation type Updated");
                            this.$router.push("/documentationType/list");
                        })
                        .catch(err => console.log(err));
                }
            },
            editdocumentationType(documentationType) {
                this.edit = true;
                this.documentationType.id = documentationType.id;
                this.documentationType.company_id = documentationType.company_id;
                this.documentationType.type = documentationType.type;
                this.documentationType.comments = documentationType.comments;
                this.documentationType.update_by = documentationType.update_by;
            }
        }
    };
</script>