<template>
	<div class="animated fadeIn">
		<div class="row">
			<div class="col-sm-12">
				<div class="card">
					<div class="card-header">
						<strong>Asset</strong>
						<small>Form</small>
						<router-link :to="{ name: 'Asset Form'}">
							<button class="btn btn-warning">Add</button>
						</router-link>
					</div>
					<div class="card-block">
						<table class="table table-striped">
							<thead>
								<tr>
									<th>Company Name</th>
									<th>Model Name</th>
									<th>Asset Name</th>
									<th>BMB No</th>
									<th>Serial No</th>
									<th>Manufacturer</th>
									<th>Description</th>
									<th>Image</th>
									<th>Quality</th>
									<th>Cost</th>
									<th>Status</th>
									<th>Minimum Stock</th>
									<th>Current Stock</th>
									<th>Comments</th>
									<th>Edit</th>
									<th>Delete</th>
								</tr>
							</thead>
							<tbody>
								<tr v-for="asset in assets" v-bind:key="asset.id">
									<td>{{ asset.company.name }}</td>
									<td>{{ asset.assetModel.name }}</td>
									<td>{{ asset.name }}</td>
									<td>{{ asset.label_value }}</td>
									<td>{{ asset.serial }}</td>
									<td>{{ asset.manufacturer.name }}</td>
									<td>{{ asset.description }}</td>
									<td>{{ asset.image }}</td>
									<td>{{ asset.quality.name }}</td>
									<td>{{ asset.cost }}</td>
									<td>{{ asset.assetLocation.location }}</td>
									<td>{{ asset.minimum_stock }}</td>
									<td>{{ asset.current_stock }}</td>
									<td>{{ asset.comments }}</td>
									<td>
										<router-link :to="{ name: 'Asset Form', params: { data: asset }}">
											<button class="btn btn-warning mb-2">Edit</button>
										</router-link>
									</td>
									<td>
										<button @click="deleteAsset(asset.id)" class="btn btn-danger">Delete</button>
									</td>
								</tr>
							</tbody>
						</table>
						<ul class="pagination">
							<li v-bind:class="[{disabled: !pagination.prev_page_url}]" class="page-item">
								<a class="page-link" href="#" @click="fetchAssets(pagination.prev_page_url)">Previous</a>
							</li>

							<li class="page-item disabled">
								<a class="page-link text-dark" href="#">Page {{ pagination.current_page }} of {{ pagination.last_page }}</a>
							</li>

							<li v-bind:class="[{disabled: !pagination.next_page_url}]" class="page-item">
								<a class="page-link" href="#" @click="fetchAssets(pagination.next_page_url)">Next</a>
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
		name: "asset",
		data() {
			return {
				selectedAccount: "",
				assets: [],
				asset: {
					id: "",
					company: {},
					asset_model: {},
					name: "",
					serial: "",
					manufacturer: {},
					label_id: "",
					label_value: "",
					description: "",
					image: "",
					quality: {},
					cost: "",
					assetLocation: {},
					image: "",
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
			this.fetchAssets();
		},
		methods: {
			fetchAssets(page_url) {
				let vm = this;
				page_url = page_url || "/api/assets";
				fetch(page_url)
				.then(res => res.json())
				.then(res => {
					this.assets = res.data;
					console.log(this.assets);
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
			deleteAsset(id) {
				if (confirm("Are You Sure?")) {
					fetch(`api/asset/${id}`, {
						method: "delete"
					})
					.then(res => res.json())
					.then(data => {
						alert("Asset Removed");
						this.fetchAssets();
					})
					.catch(err => console.log(err));
				}
			}
		}
	};
</script>