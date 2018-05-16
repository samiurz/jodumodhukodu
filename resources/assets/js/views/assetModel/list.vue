<template>
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <strong>Asset Model</strong>
                        <small>Form</small>
                        <router-link :to="{ name: 'Asset Model Form'}">
                            <button class="btn btn-warning">Add</button>
                        </router-link>
                    </div>
                    <div class="card-block">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Company Name</th>
                                    <th>Asset Name</th>
                                    <th>Serial</th>
                                    <th>Type</th>
                                    <th>Description</th>
                                    <th>Image</th>
                                    <th>Manufacturer</th>
                                    <th>Minimum Stock</th>
                                    <th>Current Stock</th>
                                    <th>Comments</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="spare in spares" v-bind:key="spare.id">
                                    <td>{{ spare.company.name }}</td>
                                    <td>{{ spare.asset.name }}</td>
                                    <td>{{ spare.serial }}</td>
                                    <td>{{ spare.cost }}</td>
                                    <td>{{ spare.description }}</td>
                                    <td>{{ spare.image }}</td>
                                    <td>{{ spare.manufacturer.name }}</td>
                                    <td>{{ spare.minimum_stock }}</td>
                                    <td>{{ spare.current_stock }}</td> 
                                    <td>{{ spare.comments }}</td>
                                    <td>                                        
                                        <router-link :to="{ name: 'Spare Form', params: { data: spare }}">
                                            <button class="btn btn-warning mb-2">Edit</button>
                                        </router-link>
                                    </td>
                                    <td>
                                        <button @click="deleteSpare(spare.id)" class="btn btn-danger">Delete</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <ul class="pagination">
                            <li v-bind:class="[{disabled: !pagination.prev_page_url}]" class="page-item">
                                <a class="page-link" href="#" @click="fetchSpares(pagination.prev_page_url)">Previous</a>
                            </li>

                            <li class="page-item disabled">
                                <a class="page-link text-dark" href="#">Page {{ pagination.current_page }} of {{ pagination.last_page }}</a>
                            </li>

                            <li v-bind:class="[{disabled: !pagination.next_page_url}]" class="page-item">
                                <a class="page-link" href="#" @click="fetchSpares(pagination.next_page_url)">Next</a>
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
        name: "spare",
        data() {
            return {
                selectedAccount: "",
                spares: [],
                spare: {
                    id: "",
                    company_id: "",
                    asset_id: "",
                    serial: "",
                    type: "",
                    description: "",
                    image: "",
                    manufacturar_id: "",
                    minimum_stock: "",
                    current_stock: "",
                    comments: "",
                    update_by: "1"
                },
                id: "",
                pagination: {},
                edit: false
            };
        },

        created() {
            this.fetchSpares();
        },
        methods: {
            fetchSpares(page_url) {
                let vm = this;
                page_url = page_url || "/api/spares";
                fetch(page_url)
                    .then(res => res.json())
                    .then(res => {
                        this.spares = res.data;
                        console.log(this.spares);
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
            deleteSpare(id) {
                if (confirm("Are You Sure?")) {
                    fetch(`api/spare/${id}`, {
                        method: "delete"
                    })
                        .then(res => res.json())
                        .then(data => {
                            alert("Spare Removed");
                            this.fetchSpares();
                        })
                        .catch(err => console.log(err));
                }
            }
        }
    };
</script>