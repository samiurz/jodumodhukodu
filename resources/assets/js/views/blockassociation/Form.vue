<template>
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <strong>Block Association</strong>
                        <small>Form</small>
                    </div>
                    <div class="card-block">
                        <form @submit.prevent="addcompany" class="mb-3">
                            <div class="row">
                                <div class="form-group col-sm-4">
                                    <label class="col-md-3 form-control-label" for="select">Accounts</label>
                                    <select id="select" name="select" class="form-control" v-model="company.account_id">
                                        <option value="">Select a Account</option>
                                        <option v-for="account in accounts" v-bind:key="account.id" v-bind:value="account.id">{{account.name}}</option>
                                    </select>
                                </div>
                                 <div class="form-group col-sm-4">
                                    <label class="col-md-3 form-control-label" for="multiple-select">Multiple select</label>
                                        <select id="multiple-select" name="multiple-select" class="form-control" size="5" multiple>
                                            <option value="1">Option #1</option>
                                            <option value="2">Option #2</option>
                                            <option value="3">Option #3</option>
                                            <option value="4">Option #4</option>
                                            <option value="5">Option #5</option>
                                            <option value="6">Option #6</option>
                                            <option value="7">Option #7</option>
                                            <option value="8">Option #8</option>
                                            <option value="9">Option #9</option>
                                            <option value="10">Option #10</option>
                                        </select>
                                </div>
                                <div class="form-group col-sm-4">
                                    <label class="col-md-3 form-control-label" for="select">Block</label>
                                    <select id="select" name="select" class="form-control" v-model="company.account_id">
                                        <option value="">Select a Account</option>
                                        <option v-for="account in accounts" v-bind:key="account.id" v-bind:value="account.id">{{account.name}}</option>
                                    </select>
                                </div>
                            </div>
                            <!--/.row-->
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
                selectedAccount: "",
                accounts: [],
                company: {
                    id: "",
                    account_id: "",
                    company_name: "",
                    is_customer: "",
                    links: "",
                    email: "",
                    address: "",
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
                            this.company.company_name = "";
                            this.company.is_customer = "";
                            this.company.links = "";
                            this.company.email = "";
                            this.company.address = "";
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
                this.company.company_name = company.company_name;
                this.company.is_customer = company.is_customer;
                this.company.links = company.links;
                this.company.email = company.email;
                this.company.address = company.address;
                this.company.update_by = company.update_by;
            }
        }
    };
</script>