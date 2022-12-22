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
                   <form @submit.prevent="storeBook">
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
    export default {
        data(){
            return{
                is_create: true,
                book:{},
                categories: [],
                authors: []
            }
        },
        created(){
            this.index()
        },
        methods:{
            index(){
                this.getCategories()
                this.getAuthors()
            },
            async getCategories(){
                const {data} = await axios.get('api/Categories/GetAllCategories')
                this.categories = data.categories
                // console.log(this.categories);
            },
            async getAuthors(){
                const {data} = await axios.get('api/Authors/GetAllAuthors')
                this.authors = data.authors
                // console.log(this.authors);
            },
            async storeBook(){

                try {

                    if (this.is_create) {
                        await axios.post('api/Books/CreateBook', this.book)
                    }else{
                         await axios.putt(`api/Books/UpdateBooks/${this.book.id}`, this.book)
                    }   
                    swal.fire({
						icon: 'success',
						title: 'Felicidades',
						text: 'Libro almacenado'
					})

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

