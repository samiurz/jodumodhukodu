<template>
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <strong>LIST</strong>
                        <small>Form</small>
                        <router-link :to="{ name: 'Account Form'}">
                            <button class="btn btn-warning">Add</button>
                        </router-link>
                    </div>
                    <div class="card-block">
                            <div class="card">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>name</th>
                                            <th>email</th>
                                            <th>comments</th>
                                            <th>Edit</th>
                                            <th>Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="account in accounts" v-bind:key="account.id">
                                            <td>{{ account.name }}</td>
                                            <td>{{ account.email }}</td>
                                            <td>{{ account.comments }}</td>
                                            <td> 
                                                 <router-link :to="{ name: 'Account Form', params: { id: account }}">
                                                    <button  class="btn btn-warning mb-2">Edit</button>
                                                </router-link>
                                            </td>
                                            <td> <button @click="deleteaccount(account.id)" class="btn btn-danger">Delete</button></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <ul class="pagination">
                                    <li v-bind:class="[{disabled: !pagination.prev_page_url}]" class="page-item">
                                        <a class="page-link" href="#" @click="fetchaccounts(pagination.prev_page_url)">Previous</a>
                                    </li>
            
                                    <li class="page-item disabled">
                                        <a class="page-link text-dark" href="#">Page {{ pagination.current_page }} of {{ pagination.last_page }}</a>
                                    </li>
            
                                    <li v-bind:class="[{disabled: !pagination.next_page_url}]" class="page-item">
                                        <a class="page-link" href="#" @click="fetchaccounts(pagination.next_page_url)">Next</a>
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
        name: "account",
        data() {
            return {
                selectedaccount: "",
                accounts: [],
                account: {
                    id: "",
                    name: "",
                    email: "",
                    comments:"",
                    update_by: "1"
                },
                id: "",
                pagination: {},
                edit: false
            };
        },

        created() {
            this.fetchaccounts();
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
            }
        }
    };
</script>