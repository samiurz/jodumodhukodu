<template>
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <strong> Spare Type</strong>
                        <small>Form</small>
                    </div>
                    <div class="card-block">
                        <form @submit.prevent="addSpareType" class="mb-3">
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label class="col-md-3 form-control-label" for="select">companys</label>
                                    <select id="select" type="select" class="form-control" v-model="spareType.company_id">
                                        <option value="">Select a company</option>
                                        <option v-for="company in companies" v-bind:key="company.id" v-bind:value="company.id">{{company.name}}</option>
                                    </select>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="spareType">Type</label>
                                    <input type="text" class="form-control" v-model="spareType.type" placeholder=" Type">
                                </div>
                            </div>
                            <div class="row">
                                  <div class="form-group col-sm-12">
                                    <label for="country">Comments</label>
                                    <textarea id="comments" type="textarea-input" rows="9" class="form-control" v-model="spareType.comments" placeholder="Comments.."></textarea>
                                </div>
                            </div>
                            <div class="form-actions">
                                <button type="submit" class="btn btn-primary">Save changes</button>
                                <router-link :to="{ type: 'Spare Type List'}">
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
        type: "spareType",
        data() {
            return {
                selectedCompany: 1,
                companies: [],
                spareType: {
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
            if (this.$route.params.data != undefined)
                this.editSpareType(this.$route.params.data);
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
            addSpareType() {
                if (this.edit === false) {
                    // Add
                    fetch("api/spareType", {
                        method: "post",
                        body: JSON.stringify(this.spareType),
                        headers: {
                            "content-type": "application/json"
                        }
                    })
                        .then(res => res.json())
                        .then(data => {
                            this.spareType.id = "";
                            this.spareType.company_id = "";
                            this.spareType.type = "";
                            this.spareType.comments = "";
                            this.spareType.update_by = "";
                            alert("Spare type Added");
                            this.$router.push("/spareType/list");
                        })
                        .catch(err => console.log(err));
                } else {
                    // Update
                    fetch("api/spareType", {
                        method: "put",
                        body: JSON.stringify(this.spareType),
                        headers: {
                            "content-type": "application/json"
                        }
                    })
                        .then(res => res.json())
                        .then(data => {
                            this.spareType.type = "";
                            this.spareType.comments = "";
                            alert("Spare type Updated");
                            this.$router.push("/spareType/list");
                        })
                        .catch(err => console.log(err));
                }
            },
            editSpareType(spareType) {
                this.edit = true;
                this.spareType.id = spareType.id;
                this.spareType.company_id = spareType.company_id;
                this.spareType.type = spareType.type;
                this.spareType.comments = spareType.comments;
                this.spareType.update_by = spareType.update_by;
            }
        }
    };
</script>