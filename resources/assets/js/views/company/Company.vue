<template>
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <strong>Company</strong>
                        <small>Form</small>
                    </div>
                    <div class="card-block">
                        <div class="row">
                            <div class="form-group col-sm-6">
                                <label class="col-md-3 form-control-label" for="select">Accounts</label>
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
                                <input type="text" class="form-control" id="company" placeholder="Enter Company Name">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-4">
                                <label for="customer">Is Customer</label>
                                <input type="text" class="form-control" id="customer" placeholder="Are You Customer?">
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="postal-code">Email</label>
                                <input type="text" class="form-control" id="email" placeholder="Enter Email Address">
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
            <!--/.col-->

            <!--/.col-->
        </div>
    </div>
    <!--/.row-->
</template>
<script>
    export default {
        name: "company",
        data() {
            return {
                options: [],
                accounts: [],
                articles: [],
                article: {
                    id: '',
                    title: '',
                    body: ''
                },
                article_id: '',
                pagination: {},
                edit: false
            };
        },

        created() {
            let options = [
                    { text: 'One', ID: 'A' },
                    { text: 'Two', ID: 'B' },
                    { text: 'Three', ID: 'C' }
                ];
        },

        methods: {
            fetchArticles(page_url) {
                let vm = this;
                page_url = page_url || '/api/accounts';
                fetch(page_url)
                    .then(res => res.json())
                    .then(res => {
                        this.articles = res.data;
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
            deleteArticle(id) {
                if (confirm('Are You Sure?')) {
                    fetch(`api/article/${id}`, {
                        method: 'delete'
                    })
                        .then(res => res.json())
                        .then(data => {
                            alert('Article Removed');
                            this.fetchArticles();
                        })
                        .catch(err => console.log(err));
                }
            },
            addArticle() {
                if (this.edit === false) {
                    // Add
                    fetch('api/article', {
                        method: 'post',
                        body: JSON.stringify(this.article),
                        headers: {
                            'content-type': 'application/json'
                        }
                    })
                        .then(res => res.json())
                        .then(data => {
                            this.article.title = '';
                            this.article.body = '';
                            alert('Article Added');
                            this.fetchArticles();
                        })
                        .catch(err => console.log(err));
                } else {
                    // Update
                    fetch('api/article', {
                        method: 'put',
                        body: JSON.stringify(this.article),
                        headers: {
                            'content-type': 'application/json'
                        }
                    })
                        .then(res => res.json())
                        .then(data => {
                            this.article.title = '';
                            this.article.body = '';
                            alert('Article Updated');
                            this.fetchArticles();
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