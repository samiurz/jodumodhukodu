<template>
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <strong>Manufacturer</strong>
                        <small>Form</small>
                    </div>
                    <div class="card-block">
                        <form @submit.prevent="addManufacturer" class="mb-3">
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label class="col-md-3 form-control-label" for="select">companys</label>
                                    <select id="select" type="select" class="form-control" v-model="manufacturer.company_id">
                                        <option value="">Select a company</option>
                                        <option v-for="company in companies" v-bind:key="company.id" v-bind:value="company.id">{{company.name}}</option>
                                    </select>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="manufacturer">Manufacturer</label>
                                    <input type="text" class="form-control" v-model="manufacturer.name" placeholder="Manufacturer">
                                </div>
                            </div>
                            <div class="row">
                                  <div class="form-group col-sm-12">
                                    <label for="country">Comments</label>
                                    <textarea id="comments" type="textarea-input" rows="9" class="form-control" v-model="manufacturer.comments" placeholder="Comments.."></textarea>
                                </div>
                            </div>
                            <div class="form-actions">
                                <button type="submit" class="btn btn-primary">Save changes</button>
                                <router-link :to="{ type: 'Manufacturer List'}">
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
        type: "manufacturer",
        data() {
            return {
                selectedCompany: 1,
                companies: [],
                manufacturer: {
                    id: "",
                    company_id: "",
                    name: "",
                    comments:"",
                    update_by: "1"
                },
                id: "",
                pagination: {},
                edit: false
            };
        },
        created() {
            console.log(this.$route.params.data);
            this.fetchCompanies();
            if (this.$route.params.data != undefined)
                this.editManufacturer(this.$route.params.data);
        },
        methods: {
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
            addManufacturer() {
                if (this.edit === false) {
                    // Add
                    fetch("api/manufacturer", {
                        method: "post",
                        body: JSON.stringify(this.manufacturer),
                        headers: {
                            "content-type": "application/json"
                        }
                    })
                        .then(res => res.json())
                        .then(data => {
                            this.manufacturer.id = "";
                            this.manufacturer.company_id = "";
                            this.manufacturer.name = "";
                            this.manufacturer.comments = "";
                            this.manufacturer.update_by = "";
                            alert("Manufacturer Added");
                            this.$router.push("/manufacturer/list");
                        })
                        .catch(err => console.log(err));
                } else {
                    // Update
                    fetch("api/manufacturer", {
                        method: "put",
                        body: JSON.stringify(this.manufacturer),
                        headers: {
                            "content-type": "application/json"
                        }
                    })
                        .then(res => res.json())
                        .then(data => {
                            this.manufacturer.name = "";
                            this.manufacturer.comments = "";
                            alert("Manufacturer Updated");
                            this.$router.push("/manufacturer/list");
                        })
                        .catch(err => console.log(err));
                }
            },
            editManufacturer(manufacturer) {
                this.edit = true;
                this.manufacturer.id = manufacturer.id;
                this.manufacturer.company_id = manufacturer.company_id;
                this.manufacturer.name = manufacturer.name;
                this.manufacturer.comments = manufacturer.comments;
                this.manufacturer.update_by = manufacturer.update_by;
            }
        }
    };
</script>