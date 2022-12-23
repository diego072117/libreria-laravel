<template>
	<div class="card mx-5 my-5">
		<div class="card-header d-flex justify-content-between">
			<h2 class="title-books">Libros</h2>
			<button @click="openModal" class="btn btn-primary btn-sm">Crear Libro</button>
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

            <section v-if="load_modal">
                <modal-component :book_data="book"/>
              
            </section>

		</div>
	</div>
</template>


<script>
import axios from 'axios'
import TableComponent from './Table.vue'
import ModalComponent from './Modal.vue'


export default {
	components: {
		TableComponent,
        ModalComponent
	},

	data() {
		return {
			books: [],
			load: false,
            load_modal: false,
            modal: null,
			book: null
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
                this.load = false
				// const { data } = await axios.get('/api/Books/GetAllBooks')
				const { data } = await axios.get('Books/GetAllBooks')
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
		},

         openModal(){
            this.load_modal = true

            setTimeout(() => {
                this.modal = new bootstrap.Modal(document.getElementById('book_modal'),{
                    Keyboard:false
                })
                this.modal.show()

                const modal = document.getElementById('book_modal')
                modal.addEventListener('hidden.bs.modal', ()=>{
                    this.load_modal = false
					this.book = null
                })

           }, 200);    
        },

        closeModal(){
             this.modal.hide()
             this.getBooks()
        },
		editBook(book){
			this.book = book
			this.openModal()
		}
        
	}
}
</script>
