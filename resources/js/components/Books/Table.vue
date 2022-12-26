<template>

                    <!-- <table class="table table-striped table-hover" id="bookTable" v-if="load" @click="getEvent"> -->
                    <table class="table table-striped table-hover" id="bookTable" @click="getEvent">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">Titulo</th>
                                <th scope="col">Autor</th>
                                <th scope="col">Categoria</th>
                                <th scope="col">Stock</th>
                                <th scope="col">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>   
                            <!-- <tr v-for="(book, index) in books" :key="index">            
                                <td>{{book.title}}</td>
                                <td>{{book.author.name}}</td>
                                <td>{{book.stock}}</td>
                                <td> -->
                                    <!-- axios -->
                                    <!-- <button class="btn btn-warning me-2" @click="getBook(book.id)">Editar</button> -->

                                    <!-- <button class="btn btn-warning me-2" @click="getBook(book)">Editar</button> 
                                    <button class="btn btn-danger" @click="deleteBook(book)">ELiminar</button>
                                </td> 
                            </tr> -->
                        </tbody>
                    </table>

          

</template>

<script>
    export default {

        //props:['books_data'],

        data(){
            return{
                // load: false,
                books:[],
                datatable:{}
            }
        },
        mounted(){
            this.index()
        },
        // mounted() {
        //     $('#bookTable').DataTable()
        // },
        methods:{
            async index(){    
                //this.books = [...this.books_data]
                //await this.getBooks()
                // this.load = true
                this.mountDataTable()
            },
            mountDataTable(){
                 this.datatable = $('#bookTable').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax:{
                        url:'/Books/GetAllBooksDataTable'
                    },
                    columns: [
                        {data: 'title'}, 
                        {data: 'author.name', searchable:false},
                        {data: 'category.name', searchable:false},
                        {data: 'stock'},
                        {data: 'action'}
                    ]
                        
                 })
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
                this.mountDataTable()
       
		    },
            getEvent(event){
                const button = event.target
                if (button.getAttribute('role') == 'edit') {
                   this.getBook(button.getAttribute('data-id'))
                }
                if (button.getAttribute('role') == 'delete') {
                   this.deleteBook(button.getAttribute('data-id'))
                }
            },
            async getBook(book_id){
                try {
                    const { data } = await axios.get(`Books/GetAnBook/${book_id}`)    
                    this.$parent.editBook(data.book) 
                    // this.$parent.editBook(book) 
                } catch (error) {
                    console.error(error);
                }
                
            },
            async deleteBook(book_id){
                try {
                    const result =  await swal.fire({
                        icon: 'info',
                        title: 'Quieres eliminar el libro?', 
                        showCancelButton: true,
                        confirmButtonText: 'Eliminar',
                        })
                
                    if (!result.isConfirmed) return
                    this.datatable.destroy()
                        // this.load = false
                        await axios.delete(`Books/DeleteBooks/${book_id}`)    
                        this.index()
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