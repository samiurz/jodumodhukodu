<template>
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <strong>Document</strong>
                        <small>Form</small>
                        <router-link :to="{ name: 'Document Form'}">
                            <button class="btn btn-warning">Add</button>
                        </router-link>
                    </div>
                    <div class="card-block">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Company Name</th>
                                    <th>Document Type</th>
                                    <th>URL</th>
                                    <th>File</th>
                                    <th>Comments</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="document in documents" v-bind:key="document.id">
                                    <td>{{ document.company.name }}</td>
                                    <td>{{ document.documentationType.name }}</td>
                                    <td>{{ document.url }}</td>
                                    <td>{{ document.file }}</td>
                                    <td>{{ document.comments }}</td>
                                    <td>                                        
                                        <router-link :to="{ name: 'Document Form', params: { data: document }}">
                                            <button class="btn btn-warning mb-2">Edit</button>
                                        </router-link>
                                    </td>
                                    <td>
                                        <button @click="fetchDocuments(document.id)" class="btn btn-danger">Delete</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <ul class="pagination">
                            <li v-bind:class="[{disabled: !pagination.prev_page_url}]" class="page-item">
                                <a class="page-link" href="#" @click="fetchDocuments(pagination.prev_page_url)">Previous</a>
                            </li>

                            <li class="page-item disabled">
                                <a class="page-link text-dark" href="#">Page {{ pagination.current_page }} of {{ pagination.last_page }}</a>
                            </li>

                            <li v-bind:class="[{disabled: !pagination.next_page_url}]" class="page-item">
                                <a class="page-link" href="#" @click="fetchDocuments(pagination.next_page_url)">Next</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/.col-->
</template>
<script>
    export default {
        name: "document",
        data() {
            return {
                selectedAccount: "",
                documents: [],
                document: {
                    id: "",
                    company_id: "",
                    asset_id: "",
                    documentation_types_id: "",
                    url: "",
                    file: "",
                    comments: "",
                    update_by: "1"
                },
                id: "",
                pagination: {},
                edit: false
            };
        },

        created() {
            this.fetchDocuments();
        },
        methods: {
            fetchDocuments(page_url) {
                let vm = this;
                page_url = page_url || "/api/documents";
                fetch(page_url)
                    .then(res => res.json())
                    .then(res => {
                        this.documents = res.data;
                        console.log(this.documents);
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
            fetchDocuments(id) {
                if (confirm("Are You Sure?")) {
                    fetch(`api/document/${id}`, {
                        method: "delete"
                    })
                        .then(res => res.json())
                        .then(data => {
                            alert("document Removed");
                            this.fetchDocuments();
                        })
                        .catch(err => console.log(err));
                }
            }
        }
    };
</script>