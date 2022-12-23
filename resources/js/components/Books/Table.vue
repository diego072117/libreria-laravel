<template>

                    <table class="table table-striped table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">Titulo</th>
                                <th scope="col">Autor</th>
                                <th scope="col">Stock</th>
                                <th scope="col">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>   
                            <tr v-for="(book, index) in books" :key="index">            
                                <td>{{book.title}}</td>
                                <td>{{book.author.name}}</td>
                                <td>{{book.stock}}</td>
                                <td>
                                    <!-- axios -->
                                    <!-- <button class="btn btn-warning me-2" @click="getBook(book.id)">Editar</button> -->

                                    <button class="btn btn-warning me-2" @click="getBook(book)">Editar</button> 
                                    <button class="btn btn-danger" @click="deleteBook(book)">ELiminar</button>
                                </td> 
                            </tr>
                                
                        </tbody>
                    </table>

          

</template>

<script>
    export default {

        props:['books_data'],

        data(){
            return{
                books:[]
            }
        },
        created(){
            this.index()
        },
        methods:{
            index(){    
                this.books = [...this.books_data]
            },
            async getBook(book){
                try {
                    // const { data } = await axios.get(`Books/GetAnBook/${book_id}`)    
                    // this.$parent.editBook(data.book) 
                    this.$parent.editBook(book) 
                } catch (error) {
                    console.error(error);
                }
                
            },
            async deleteBook(book){
                try {
                    const result =  await swal.fire({
                        icon: 'info',
                        title: 'Quieres eliminar el libro?', 
                        showCancelButton: true,
                        confirmButtonText: 'Eliminar',
                        })
                
                        if (!result.isConfirmed) return

                    await axios.delete(`Books/DeleteBooks/${book.id}`)    
                        this.$parent.getBooks()
                        swal.fire({
                                icon: 'success',
                                title: 'Felicidades',
                                text: 'Libro Eliminado'
                            })
                } catch (error) {
                    console.error(error);
                }
                
            }
        }
      

    }
</script>