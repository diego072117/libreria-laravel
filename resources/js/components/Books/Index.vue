<template>
	<div class="card mx-5 my-5">
		<div class="card-header d-flex justify-content-between">
			<h2>Libros</h2>
			<a class="btn btn-primary btn-sm">Crear Libro</a>
		</div>

		<div class="card-body">
			<section class="table-responsive d-flex" v-if="load">
				<table-component :books_data="books" />
			</section>
            <!-- Load -->
			<section v-else class="d-flex justify-content-center my-3">
				<div class="spinner-border text-secondary" role="status">
					<span class="visually-hidden">Loading...</span>
				</div>
			</section>
		</div>
	</div>
</template>

<script>
import axios from 'axios'
import TableComponent from './Table.vue'

export default {
	components: {
		TableComponent
	},

	data() {
		return {
			books: [],
			load: false
		}
	},
	created() {
		this.index()
	},
	methods: {
		async index() {
			await this.getBooks()
			// this.books = await this.getBooks()
			// console.log(this.books);
		},
		async getBooks() {
			try {
				const { data } = await axios.get('/api/Books/GetAllBooks')
				this.books = data.books
				this.load = true
			} catch (error) {
				console.errror(error)
			}

			// return axios.get('/api/Books/GetAllBooks').then(response => {
			//     this.books = response.data.books
			//     console.log(this.books);
			// }).catch(error => {
			//     console.log(error);
			// })
		}
	}
}
</script>
