<template>
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <strong>Asset Location</strong>
                        <small>Form</small>
                        <router-link :to="{ name: 'Asset Location Form'}">
                            <button class="btn btn-warning">Add</button>
                        </router-link>
                    </div>
                    <div class="card-block">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Company Name</th>
                                    <th>Location</th>
                                    <th>Comments</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="assetLocation in assetLocations" v-bind:key="assetLocation.id">
                                    <td>{{ assetLocation.company.name }}</td>
                                    <td>{{ assetLocation.location }}</td>
                                    <td>{{ assetLocation.comments }}</td>
                                    <td>                                        
                                        <router-link :to="{ name: 'Asset Location Form', params: { data: assetLocation }}">
                                            <button class="btn btn-warning mb-2">Edit</button>
                                        </router-link>
                                    </td>
                                    <td>
                                        <button @click="deleteAssetLocation(assetLocation.id)" class="btn btn-danger">Delete</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <ul class="pagination">
                            <li v-bind:class="[{disabled: !pagination.prev_page_url}]" class="page-item">
                                <a class="page-link" href="#" @click="fetchAssetLocations(pagination.prev_page_url)">Previous</a>
                            </li>

                            <li class="page-item disabled">
                                <a class="page-link text-dark" href="#">Page {{ pagination.current_page }} of {{ pagination.last_page }}</a>
                            </li>

                            <li v-bind:class="[{disabled: !pagination.next_page_url}]" class="page-item">
                                <a class="page-link" href="#" @click="fetchAssetLocations(pagination.next_page_url)">Next</a>
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
        name: "assetLocation",
        data() {
            return {
                companies:[],
                assetLocations: [],
                assetLocation: {
                    id: "",
                    company_id: "",
                    location: "",
                    comments: "",
                    update_by: "1"
                },
                id: "",
                pagination: {},
                edit: false
            };
        },

        created() {
            this.fetchAssetLocations();
            this.fetchCompanies();
        },
        methods: {
            fetchAssetLocations(page_url) {
                let vm = this;
                page_url = page_url || "/api/assetLocations";
                fetch(page_url)
                    .then(res => res.json())
                    .then(res => {
                        this.assetLocations = res.data;
                        console.log(this.assetLocations);
                        vm.makePagination(res.meta, res.links);
                    })
                    .catch(err => console.log(err));
            },
            fetchCompanies(page_url) {
                let vm = this;
                page_url = page_url || "/api/companies";
                fetch(page_url)
                    .then(res => res.json())
                    .then(res => {
                        this.companies = res.data;
                        console.log(this.companies);
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
            deleteAssetLocation(id) {
                if (confirm("Are You Sure?")) {
                    fetch(`api/assetLocation/${id}`, {
                        method: "delete"
                    })
                        .then(res => res.json())
                        .then(data => {
                            alert("Asset Location Removed");
                            this.fetchAssetLocations();
                        })
                        .catch(err => console.log(err));
                }
            }
        }
    };
</script>