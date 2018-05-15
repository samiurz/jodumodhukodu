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
                        <form @submit.prevent="addAccountBlockAssociation" class="mb-3">
                            <div class="row">
                                <div class="form-group col-sm-4">
                                    <label class="col-md-3 form-control-label" for="select">Accounts</label>
                                    <select id="select" name="select" class="form-control" v-model="accountBlockAssociation.account_id">
                                        <option value="">Select a Account</option>
                                        <option v-for="account in accounts" v-bind:key="account.id" v-bind:value="account.id">{{account.name}}</option>
                                    </select>
                                </div>
                                <div class="form-group col-sm-4">
                                    <label class="col-md-3 form-control-label" for="select">Accounts</label>
                                    <select id="select" name="select" class="form-control" v-model="accountBlockAssociation.block_id">
                                        <option value="">Select Block</option>
                                        <option v-for="block in blocks" v-bind:key="block.id" v-bind:value="block.id">{{block.name}}</option>
                                    </select>
                                </div>
                                <div class="form-group col-sm-4">
                                    <label class="col-md-3 form-control-label" for="select">Status</label>
                                    <select id="select" name="select" class="form-control" v-model="accountBlockAssociation.block_stat_id">
                                        <option value="">Select Block Stats</option>
                                        <option v-for="blockStat in blockStats" v-bind:key="blockStat.id" v-bind:value="blockStat.id">{{blockStat.name}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-sm-12">
                                <label for="customer">Comment</label>
                                <textarea id="textarea-input" name="textarea-input" v-model="accountBlockAssociation.comments" rows="9" class="form-control"
                                    placeholder="Comments.."></textarea>
                            </div>
                            <!--/.row-->
                            <div class="form-actions">
                                <button type="submit" class="btn btn-primary">Save changes</button>
                                <router-link :to="{ name: 'Account Block Association List'}">
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
        name: "accountBlockAssociation",
        data() {
            return {
                accounts: [],
                blocks:[],
                blockStats:[],
                accountBlockAssociation: {
                    id: "",
                    account_id: "",
                    block_id: "",
                    block_stat_id: "",
                    comments: "",
                    is_enabled: "1",
                    created_by:"1",
                    update_by: "1"
                },
                id: "",
                pagination: {},
                edit: false
            };
        },

        created() {
            this.fetchAccounts();
            this.fetchBlocks();
            this.fetchBlockStats();
            if (this.$route.params.data != undefined)
                this.editAccountBlockAssociation(this.$route.params.data);
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
            fetchBlockStats(page_url) {
                let vm = this;
                page_url = page_url || "/api/blockStats";
                fetch(page_url)
                    .then(res => res.json())
                    .then(res => {
                        this.blockStats = res.data;
                        console.log(this.blockStats);
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
            addAccountBlockAssociation() {
                if (this.edit === false) {
                    // Add
                    fetch("api/accountBlockAssociation", {
                        method: "post",
                        body: JSON.stringify(this.accountBlockAssociation),
                        headers: {
                            "content-type": "application/json"
                        }
                    })
                        .then(res => res.json())
                        .then(data => {
                            this.accountBlockAssociation.account_id = "";
                            this.accountBlockAssociation.block_id = "";
                            this.accountBlockAssociation.block_stat_id = "";
                            this.accountBlockAssociation.comments = "";
                            this.accountBlockAssociation.is_enabled = "";
                            this.accountBlockAssociation.created_by = "";
                            this.accountBlockAssociation.update_by = "";
                            alert("Account Block Association Added");
                            this.$router.push('/accountBlockAssociation/list');
                        })
                        .catch(err => console.log(err));
                } else {
                    // Update
                    fetch("api/accountBlockAssociation", {
                        method: "put",
                        body: JSON.stringify(this.accountBlockAssociation),
                        headers: {
                            "content-type": "application/json"
                        }
                    })
                        .then(res => res.json())
                        .then(data => {
                            this.accountBlockAssociation.account_id = "";
                            this.accountBlockAssociation.block_id = "";
                            this.accountBlockAssociation.block_stat_id = "";
                            this.accountBlockAssociation.comments = "";
                            this.accountBlockAssociation.update_by = "";
                            alert("Account Block Association Updated");
                            this.$router.push('/accountBlockAssociation/list');
                        })
                        .catch(err => console.log(err));
                }
            },
            editAccountBlockAssociation(accountBlockAssociation) {
                this.edit = true;
                this.accountBlockAssociation.id = accountBlockAssociation.id;
                this.accountBlockAssociation.account_id = accountBlockAssociation.account_id;
                this.accountBlockAssociation.block_id = accountBlockAssociation.block_id;
                this.accountBlockAssociation.block_stat_id = accountBlockAssociation.block_stat_id;
                this.accountBlockAssociation.comments = accountBlockAssociation.comments;
                this.accountBlockAssociation.is_enabled = accountBlockAssociation.is_enabled;
                this.accountBlockAssociation.created_by = accountBlockAssociation.created_by;
                this.accountBlockAssociation.update_by = accountBlockAssociation.update_by;
            }
        }
    };
</script>