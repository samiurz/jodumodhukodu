<template>
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <strong>Company</strong>
                        <small>Form</small>
                    </div>
                    <div class="card-block">
                        <form @submit.prevent="addcompany" class="mb-3">
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label class="col-md-3 form-control-label" for="select">Accounts</label>
                                    <select id="select" name="select" class="form-control" v-model="company.account_id">
                                        <option value="">Select a Account</option>
                                        <option v-for="account in accounts" v-bind:key="account.id" v-bind:value="account.id">{{account.name}}</option>
                                    </select>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="company">Company Name</label>
                                    <input type="text" class="form-control" v-model="company.name" placeholder="Nestle Professional">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-4">
                                    <label for="customer">Links</label>
                                    <input type="text" class="form-control" v-model="company.links" placeholder="www.nestle.co.nz">
                                </div>
                                <div class="form-group col-sm-4">
                                    <label for="postal-code">Email</label>
                                    <input type="text" class="form-control" v-model="company.email" placeholder="tech.nestle@nestle.co.nz">
                                </div>
                                <div class="form-group col-sm-4">
                                    <label class="col-md-3 form-control-label">Customer?</label>
                                    <div class="checkbox">
                                        <label for="checkbox1">
                                            <input type="checkbox" id="checkbox1" name="checkbox1" v-model="company.is_customer" value="0"> No/Yes
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label for="country">Address</label>
                                    <textarea id="address" name="textarea-input" rows="9" class="form-control" v-model="company.address" placeholder="Address.."></textarea>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="country">Comments</label>
                                    <textarea id="comments" name="textarea-input" rows="9" class="form-control" v-model="company.comments" placeholder="Comments.."></textarea>
                                </div>
                            </div>
                            <div class="form-actions">
                                <button type="submit" class="btn btn-primary">Save changes</button>
                                <router-link :to="{ name: 'Company List'}">
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
        name: "company",
        data() {
            return {
                selectedAccount: 1,
                accounts: [],
                company: {
                    id: "",
                    account_id: "",
                    name: "",
                    is_customer: "",
                    links: "",
                    email: "",
                    address: "",
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
            this.fetchAccounts();
            if (this.$route.params.data != undefined)
                this.editcompany(this.$route.params.data);
        },
        methods: {
            fetchAccounts(page_url) {
                let vm = this;
                page_url = page_url || "/api/accounts";
                fetch(page_url)
                    .then(res => res.json())
                    .then(res => {
                        this.accounts = res.data;
                        console.log(this.accounts);
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
            addcompany() {
                if (this.company.is_customer === '') {
                    this.company.is_customer = false
                }
                if (this.edit === false) {
                    // Add
                    fetch("api/company", {
                        method: "post",
                        body: JSON.stringify(this.company),
                        headers: {
                            "content-type": "application/json"
                        }
                    })
                        .then(res => res.json())
                        .then(data => {
                            this.company.account_id = "";
                            this.company.name = "";
                            this.company.is_customer = "";
                            this.company.links = "";
                            this.company.email = "";
                            this.company.address = "";
                            this.company.comments = "";
                            this.company.update_by = "";
                            alert("Company Added");
                            this.$router.push("/company/list");
                        })
                        .catch(err => console.log(err));
                } else {
                    // Update
                    fetch("api/company", {
                        method: "put",
                        body: JSON.stringify(this.company),
                        headers: {
                            "content-type": "application/json"
                        }
                    })
                        .then(res => res.json())
                        .then(data => {
                            this.company.name = "";
                            alert("Company Updated");
                            this.$router.push("/company/list");
                        })
                        .catch(err => console.log(err));
                }
            },
            editcompany(company) {
                this.edit = true;
                this.company.id = company.id;
                this.company.account_id = company.account_id;
                this.company.name = company.name;
                this.company.is_customer = company.is_customer;
                this.company.links = company.links;
                this.company.email = company.email;
                this.company.address = company.address;
                this.company.comments = company.comments;
                this.company.update_by = company.update_by;
            }
        }
    };
</script>