<template>
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <strong>Account Block Association</strong>
                        <small>Form</small>
                        <router-link :to="{ name: 'Account Block Association Form'}">
                            <button class="btn btn-warning">Add</button>
                        </router-link>
                    </div>
                    <div class="card-block">
                        <div class="card">
                            <table class="table" v-for="accountBlockAssociation in accountBlockAssociations" v-bind:key="accountBlockAssociation.id">
                                <thead>
                                    <tr>
                                        <th>Account Name</th>
                                        <th>Block Name</th>
                                        <th>Block Status</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ accountBlockAssociation.account.name }}</td>
                                        <td>{{ accountBlockAssociation.block.name }}</td>
                                        <td>{{ accountBlockAssociation.blockStat.name }}</td>
                                        <td>
                                            <button class="btn btn-warning mb-2">
                                                <router-link :to="{ name: 'Account Block Association Form', params: { data: accountBlockAssociation }}">Edit</router-link>
                                            </button>
                                        </td>
                                        <td>
                                            <button @click="deleteAccountBlockAssociation(accountBlockAssociation.id)" class="btn btn-danger">Delete</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <ul class="pagination">
                                <li v-bind:class="[{disabled: !pagination.prev_page_url}]" class="page-item">
                                    <a class="page-link" href="#" @click="fetchAccountBlockAssociations(pagination.prev_page_url)">Previous</a>
                                </li>

                                <li class="page-item disabled">
                                    <a class="page-link text-dark" href="#">Page {{ pagination.current_page }} of {{ pagination.last_page }}</a>
                                </li>

                                <li v-bind:class="[{disabled: !pagination.next_page_url}]" class="page-item">
                                    <a class="page-link" href="#" @click="fetchAccountBlockAssociations(pagination.next_page_url)">Next</a>
                                </li>
                            </ul>
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
        name: "accountBlockAssociation",
        data() {
            return {
                accountBlockAssociations:[],
                accounts: [],
                blocks:[],
                accountBlockAssociation: {
                    id: "",
                    account_id: "",
                    block_id: "",
                    block_stat_id: "",
                    comments: "",
                    update_by: "1"
                },
                id: "",
                pagination: {},
                edit: false
            };
        },

        created() {
            this.fetchAccountBlockAssociations();
            this.fetchBlockStats();
            this.fetchBlocks();
            this.fetchAccounts();
        },

        methods: {
            fetchAccountBlockAssociations(page_url) {
                let vm = this;
                page_url = page_url || "/api/accountBlockAssociations";
                fetch(page_url)
                    .then(res => res.json())
                    .then(res => {
                        this.accountBlockAssociations = res.data;
                        console.log(this.accountBlockAssociations);
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
                    })
                    .catch(err => console.log(err));
            },
            fetchAccounts(page_url) {
                let vm = this;
                page_url = page_url || "/api/accounts";
                fetch(page_url)
                    .then(res => res.json())
                    .then(res => {
                        this.accounts = res.data;
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
            deleteAccountBlockAssociation(id) {
                if (confirm("Are You Sure?")) {
                    fetch(`api/accountBlockAssociation/${id}`, {
                        method: "delete"
                    })
                        .then(res => res.json())
                        .then(data => {
                            alert("Account BlockAssociation Removed");
                            this.fetchAccountBlockAssociations();
                        })
                        .catch(err => console.log(err));
                }
            }
        }
    };
</script>