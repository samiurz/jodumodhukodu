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
                                <div class="form-group col-sm-3">
                                    <label for="customer">Account Name</label>
                                    <input type="text" class="form-control" placeholder="Enter account Name" v-model="account.name">
                                </div>
                                 <div class="form-group col-sm-3">
                                    <label for="customer">Email</label>
                                    <input type="text" class="form-control" placeholder="Enter Email Address" v-model="account.email">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="customer">Comment</label>
                                    <textarea id="textarea-input" name="textarea-input" v-model="account.comments" rows="9" class="form-control" placeholder="Comment.."></textarea>
                                </div>
                            </div>
                            <!--/.row-->
                            <div class="form-actions">
                                <button type="submit" class="btn btn-primary">Save changes</button>
                                <router-link :to="{ name: 'Account List'}">
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
        name: "account",
        data() {
            return {
                selectedaccount: "",
                accounts: [],
                account: {
                    id: "",
                    name: "",
                    email: "",
                    comments: "",
                    is_enabled:"1",
                    created_by:"1",
                    update_by: "1"
                },
                id: "",
                pagination: {},
                edit: false
            };
        },

        created() {
            if (this.$route.params.id != undefined)
                this.editaccount(this.$route.params.id);
        },

        methods: {
            fetchaccounts(page_url) {
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
            deleteaccount(id) {
                if (confirm("Are You Sure?")) {
                    fetch(`api/account/${id}`, {
                        method: "delete"
                    })
                        .then(res => res.json())
                        .then(data => {
                            alert("account Removed");
                            this.fetchaccounts();
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
                            this.account.comments = "";
                            this.account.is_enabled = "";
                            alert("account Added");
                            this.$router.push('/account/list');
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
                            alert("account Updated");
                            this.$router.push('/account/list');
                        })
                        .catch(err => console.log(err));
                }
            },
            editaccount(account) {
                this.edit = true;
                this.account.id = account.id;
                this.account.name = account.name;
                this.account.email = account.email;
                this.account.comments = account.comments;
                this.account.is_enabled = account.is_enabled;
                this.account.created_by = account.created_by;
                this.account.update_by = account.update_by;
            }
        }
    };
</script>