<template>
    <div class="modal fade" id="book_modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fs-5" id="exampleModalLabel">
                        {{`${is_create?'Crear':'Actualizar'} libro`}}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                   <form @submit.prevent="storeBook" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="image" class="form-label">Imagen</label>
                            <input type="file" class="form-control" id="image" accept="image/*" @change="loadImage">
                        </div>
                        <div class="mb-3">
                            <label for="title" class="form-label">Titulo</label>
                            <input type="text" class="form-control" id="title" v-model="book.title">
                        </div>
                        <div class="mb-3">
                            <label for="stock" class="form-label">Stock</label>
                            <input type="number" class="form-control" id="stock" v-model="book.stock">
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Descripcion</label>
                            <textarea rows="3" class="form-control" id="description" v-model="book.description"></textarea>
                        </div>

                          <div class="mb-3">
                            <label for="description" class="form-label">Categoria</label>
                             <v-select :options="categories" v-model="book.category_id" :reduce="category => category.id" 
                                label="name"></v-select> 
                                <!-- :clearable="false" -->
                        </div>

                          <div class="mb-3">
                            <label for="description" class="form-label">Autor</label>
                            <v-select :options="authors" v-model="book.author_id" :reduce="author => author.id" 
                                label="name"></v-select>
                        </div>

                       

                        <hr>
                        <section class="d-flex justify-content-end mt-3">
                            <button type="button" class="btn btn-secondary me-1" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary me-1"> {{`${is_create?'Crear':'Actualizar'} libro`}}</button>
                        </section>
                        
                    </form>
                </div>
            
            </div>
        </div>
    </div>
</template>

<script>

import axios from 'axios'

    export default {
        props: ['book_data'],
        data(){
            return{
                is_create: true,
                book:{},
                categories: [],
                authors: [],
                file: null
            }
        },
        created(){
            this.index()
        },
        methods:{
            index(){
                this.getCategories()
                this.getAuthors()
                this.setBook()
            },
            setBook(){
                if(!this.book_data) return
                this.book = {...this.book_data}
                this.is_create = false
            },
            loadImage(event){
                this.file = event.target.files[0]
            },
            loadFormData(){
                const form_data = new FormData()
                if(this.file)  form_data.append('image', this.file, this.file.name)
                form_data.append('title', this.book.title)
                form_data.append('stock', this.book.stock)
                form_data.append('description', this.book.description)
                form_data.append('category_id', this.book.category_id)
                form_data.append('author_id', this.book.author_id)
                return form_data
            },
            async getCategories(){
                // const {data} = await axios.get('api/Categories/GetAllCategories')
                const {data} = await axios.get('Categories/GetAllCategories')
                this.categories = data.categories
                // console.log(this.categories);
            },
            async getAuthors(){
                const {data} = await axios.get('Authors/GetAllAuthors')
                this.authors = data.authors
                // console.log(this.authors);
            },
            async storeBook(){

                try {
                    const book = this.loadFormData()
                    if (this.is_create) {
                        await axios.post('Books/CreateBook', book)
                    }else{
                         await axios.post(`Books/UpdateBooks/${this.book.id}`, book)
                    }   

                      if (this.is_create) {
                        swal.fire({
						icon: 'success',
						title: 'Felicidades',
						text: 'Libro creado'
					})
                    }else{
                          swal.fire({
						icon: 'success',
						title: 'Felicidades',
						text: 'Libro actualizado'
					})
                    }
                    // swal.fire({
					// 	icon: 'success',
					// 	title: 'Felicidades',
					// 	text: 'Libro almacenado'
					// })

                    this.$parent.closeModal()
                } catch (error) {
                    console.error(error);
                    swal.fire({
						icon: 'error',
						title: 'Oops...',
						text: 'Algo salio mal'
					})
                }
               
                
            }
        }
    }
</script>

