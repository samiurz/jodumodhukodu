<template>
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-sm-12">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#account" role="tab" aria-controls="account">Account</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#company" role="tab" aria-controls="company">Company</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#contact" role="tab" aria-controls="contact">Contact</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="account" role="tabpanel">
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
                                        <select id="select" name="select" class="form-control">
                                            <option value="0">Please select</option>
                                            <option value="1">JLE</option>
                                            <option value="2">Dyson</option>
                                        </select>
                                        <!-- <select id="account" name="select" class="form-control">
                                                            <option v-for="option in options" v-bind:value="option.ID">
                                                                {{ option.text }}
                                                            </option>
                                                        </select> -->
                                        <!-- <select v-model="accounts" class="Radio__admin">
                                                                            <option disabled selected>Type?</option>
                                                                            <option v-for="account in accounts" v-bind:value="account.id">
                                                                </select>   
                                                                <select v-model="selected">
                                                                    <option v-for="option in options" v-bind:value="option.ID">
                                                                        {{ option.text }}
                                                                    </option>
                                                                </select> -->
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
                                <select id="select" name="select" class="form-control">
                                    <option value="0">Select A Company</option>
                                    <option value="1">Nestle Professional</option>
                                    <option value="2">Air NZ</option>
                                </select>
                                <!-- <select id="account" name="select" class="form-control">
                                                            <option v-for="option in options" v-bind:value="option.ID">
                                                                {{ option.text }}
                                                            </option>
                                                        </select> -->
                                <!-- <select v-model="accounts" class="Radio__admin">
                                                                            <option disabled selected>Type?</option>
                                                                            <option v-for="account in accounts" v-bind:value="account.id">
                                                                </select>   
                                                                <select v-model="selected">
                                                                    <option v-for="option in options" v-bind:value="option.ID">
                                                                        {{ option.text }}
                                                                    </option>
                                                                </select> -->
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="company">Contact</label>
                                <input type="text" class="form-control" id="contact" placeholder="Paul Stevenson">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-6">
                                <label for="postal-code">Email</label>
                                <input type="text" class="form-control" id="contact_email" placeholder="paul.stevenson@jle.co.nz">
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="company">Password</label>
                                <input type="password" class="form-control" id="password" placeholder="Enter Password">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-6">
                                <label for="postal-code">Phone</label>
                                <input type="text" class="form-control" id="contact_phone" placeholder="02108535263">
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
        </div>
    </div>
    <!--/.col-->
</template>
<script>
    export default {
        name: "company",
        data() {
            return {
                accounts: [],
                account: {
                    id: "",
                    name: "",
                    email: "",
                    update_by:"1"
                },
                id: "",
                pagination: {},
                edit: false
            };
        },
        methods: {
            fetchAccounts(page_url) {
                let vm = this;
                page_url = page_url || "/api/accounts";
                fetch(page_url)
                    .then(res => res.json())
                    .then(res => {
                        this.accounts = res.data;
                        console.log(res);
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