<template>
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                <strong>Account</strong>
                                <small>Form</small>
                            </div>
                            <div class="card-block">
                                <form @submit.prevent="addAccount" class="mb-3">
                                    <div class="row">
                                        <div class="form-group col-sm-6">
                                            <label for="customer">Account</label>
                                            <input type="text" class="form-control" placeholder="JLE" v-model="account.name">
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <label for="postal-code">Email</label>
                                            <input type="text" class="form-control" v-model="account.email" placeholder="craig.brydon@jle.co.nz">
                                        </div>
                                    </div>
                                    <!--/.row-->
                                    <div class="form-actions">
                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                        <button type="button" class="btn btn-default">Cancel</button>
                                    </div>
                                </form>
                            </div>
                            <nav aria-label="Page navigation example">
                                <ul class="pagination">
                                    <li v-bind:class="[{disabled: !pagination.prev_page_url}]" class="page-item">
                                        <a class="page-link" href="#" @click="fetchAccounts(pagination.prev_page_url)">Previous</a>
                                    </li>

                                    <li class="page-item disabled">
                                        <a class="page-link text-dark" href="#">Page {{ pagination.current_page }} of {{ pagination.last_page }}</a>
                                    </li>

                                    <li v-bind:class="[{disabled: !pagination.next_page_url}]" class="page-item">
                                        <a class="page-link" href="#" @click="fetchAccounts(pagination.next_page_url)">Next</a>
                                    </li>
                                </ul>
                            </nav>
                            <div class="card card-body mb-2" v-for="account in accounts" v-bind:key="account.id">
                                <h3>{{ account.name }}</h3>
                                <p>{{ account.email }}</p>
                                <hr>
                                <button @click="editAccount(account)" class="btn btn-warning mb-2">Edit</button>
                                <button @click="deleteAccount(account.id)" class="btn btn-danger">Delete</button>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="company" role="tabpanel">
                        <div class="card">
                            <div class="card-header">
                                <strong>Company</strong>
                                <small>Form</small>
                            </div>
                            <div class="card-block">
                                <div class="row">
                                    <div class="form-group col-sm-6">
                                        <label class="col-md-3 form-control-label" for="select">Accounts</label>
                                        <select id="select" name="select" class="form-control" v-model="selectedAccount">
                                            <option value="">Select a Account</option>
                                            <option v-for="account in accounts" v-bind:key="account.id" v-bind:value="account.id">{{account.name}}</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label for="company">Company Name</label>
                                        <input type="text" class="form-control" id="company" placeholder="Nestle Professional">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-sm-4">
                                        <label for="customer">Links</label>
                                        <input type="text" class="form-control" id="company_links" placeholder="www.nestle.co.nz">
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label for="postal-code">Email</label>
                                        <input type="text" class="form-control" id="company_email" placeholder="tech.nestle@nestle.co.nz">
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label class="col-md-3 form-control-label">Customer?</label>
                                        <div class="checkbox">
                                            <label for="checkbox1">
                                                <input type="checkbox" id="checkbox1" name="checkbox1" value="option1"> No/Yes
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <!--/.row-->
                                <div class="form-group">
                                    <label for="country">Address</label>
                                    <textarea id="address" name="textarea-input" rows="9" class="form-control" placeholder="Content.."></textarea>
                                </div>
                                <div class="form-actions">
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                    <button type="button" class="btn btn-default">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="contact" role="tabpanel">
                        <div class="row">
                            <div class="form-group col-sm-6">
                                <label class="col-md-3 form-control-label" for="select">Company</label>
                                <select id="select" name="select" class="form-control" v-model="selectedAccount">
                                    <option value="">Select a Account</option>
                                    <option v-for="account in accounts" v-bind:key="account.id" v-bind:value="account.id">{{account.name}}</option>
                                </select>
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="company">Contact</label>
                                <input type="text" class="form-control" id="contact" placeholder="Paul Stevenson" v-model="selectedAccount">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-6">
                                <label for="postal-code">Email</label>
                                <input type="text" class="form-control" placeholder="paul.stevenson@jle.co.nz">
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="company">Password</label>
                                <input type="password" class="form-control" id="password" placeholder="Enter Password">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-6">
                                <label for="postal-code">Phone</label>
                                <input type="text" class="form-control" id="contact_email" placeholder="02108535263">
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="company">Links</label>
                                <input type="text" class="form-control" id="contact_links" placeholder="www.nestle.co.nz">
                            </div>
                        </div>
                        <!--/.row-->
                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary">Save changes</button>
                            <button type="button" class="btn btn-default">Cancel</button>
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
                account: {
                    id: "",
                    name: "",
                    email: "",
                    update_by: "1"
                },
                id: "",
                pagination: {},
                edit: false
            };
        },

        created() {
            this.fetchAccounts();
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
            deleteAccount(id) {
                if (confirm("Are You Sure?")) {
                    fetch(`api/account/${id}`, {
                        method: "delete"
                    })
                        .then(res => res.json())
                        .then(data => {
                            alert("Account Removed");
                            this.fetchAccounts();
                        })
                        .catch(err => console.log(err));
                }
            },
            addAccount() {
                if (this.edit === false) {
                    // Add
                    fetch("api/account", {
                        method: "post",
                        body: JSON.stringify(this.account),
                        headers: {
                            "content-type": "application/json"
                        }
                    })
                        .then(res => res.json())
                        .then(data => {
                            this.account.name = "";
                            this.account.email = "";
                            alert("Account Added");
                            this.fetchAccounts();
                        })
                        .catch(err => console.log(err));
                } else {
                    // Update
                    fetch("api/account", {
                        method: "put",
                        body: JSON.stringify(this.account),
                        headers: {
                            "content-type": "application/json"
                        }
                    })
                        .then(res => res.json())
                        .then(data => {
                            this.account.name = "";
                            this.account.email = "";
                            alert("Account Updated");
                            this.fetchAccounts();
                        })
                        .catch(err => console.log(err));
                }
            },
            editAccount(account) {
                this.edit = true;
                this.account.id = account.id;
                this.account.name = account.name;
                this.account.email = account.email;
                this.account.update_by = account.update_by;
            }
        }
    };
</script>