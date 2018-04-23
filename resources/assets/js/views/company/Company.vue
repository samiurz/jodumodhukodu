<template>
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-sm-12">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#account" role="tab" aria-controls="account">Account</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#company" role="tab" aria-controls="company">Company</a>
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
                                <div class="row">
                                    <div class="form-group col-sm-6">
                                        <label for="customer">Account</label>
                                        <input type="text" class="form-control" id="account" placeholder="JLE">
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label for="postal-code">Email</label>
                                        <input type="text" class="form-control" id="account_email" placeholder="craig.brydon@jle.co.nz">
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
                                        <!-- <select id="select" name="select" class="form-control">
                                            <option value="0">Please select</option>
                                            <option value="1">JLE</option>
                                            <option value="2">Dyson</option>
                                        </select> -->
                                        <select id="account" name="select" class="form-control">
                                            <option v-for="option in options" v-bind:value="option.ID">
                                                {{ option.text }}
                                            </option>
                                        </select>
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
                                <select id="select" name="select" class="form-control" v-model="selectedAccount">
                                    <option value="">Select a Account</option>
                                    <option v-for="account in accounts"  v-bind:key="account.id" v-bind:value="account.id">{{account.name}}</option>
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
                options: [],
                accounts: [
                    {
                        id: 18,
                        name: "In debitis ab aliquid.",
                        email: "lucas26@example.com",
                        update_by: "Aut quod nihil rerum."
                    },
                    {
                        id: 19,
                        name: "Est dolor eos soluta ullam.",
                        email: "dboyle@example.org",
                        update_by: "Maxime ut est doloremque."
                    },
                    {
                        id: 20,
                        name: "Culpa neque qui vitae.",
                        email: "lkohler@example.net",
                        update_by: "Sit omnis minima quaerat."
                    },
                    {
                        id: 21,
                        name: "Eius totam dolorem sint.",
                        email: "kgleichner@example.com",
                        update_by: "Veniam impedit maiores rerum."
                    },
                    {
                        id: 22,
                        name: "Aliquid esse nisi suscipit.",
                        email: "qdubuque@example.org",
                        update_by: "Quod sed ea corporis laborum."
                    }
                ],
                articles: [],
                article: {
                    id: "",
                    title: "",
                    body: ""
                },
                article_id: "",
                pagination: {},
                edit: false
            };
        },

        created() {
            this.fetchAccounts();
            let options = [
                { text: "One", ID: "A" },
                { text: "Two", ID: "B" },
                { text: "Three", ID: "C" }
            ];
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
            deleteArticle(id) {
                if (confirm("Are You Sure?")) {
                    fetch(`api/article/${id}`, {
                        method: "delete"
                    })
                        .then(res => res.json())
                        .then(data => {
                            alert("Article Removed");
                            this.fetchAccounts();
                        })
                        .catch(err => console.log(err));
                }
            },
            addArticle() {
                if (this.edit === false) {
                    // Add
                    fetch("api/article", {
                        method: "post",
                        body: JSON.stringify(this.article),
                        headers: {
                            "content-type": "application/json"
                        }
                    })
                        .then(res => res.json())
                        .then(data => {
                            this.article.title = "";
                            this.article.body = "";
                            alert("Article Added");
                            this.fetchAccounts();
                        })
                        .catch(err => console.log(err));
                } else {
                    // Update
                    fetch("api/article", {
                        method: "put",
                        body: JSON.stringify(this.article),
                        headers: {
                            "content-type": "application/json"
                        }
                    })
                        .then(res => res.json())
                        .then(data => {
                            this.article.title = "";
                            this.article.body = "";
                            alert("Article Updated");
                            this.fetchAccounts();
                        })
                        .catch(err => console.log(err));
                }
            },
            editArticle(article) {
                this.edit = true;
                this.article.id = article.id;
                this.article.article_id = article.id;
                this.article.title = article.title;
                this.article.body = article.body;
            }
        }
    };
</script>