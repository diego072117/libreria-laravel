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
                                    <button class="btn btn-warning me-2">Editar</button>
                                    <button class="btn btn-danger">ELiminar</button>
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
                this.books = {...this.books_data}
            }
        }
      

    }
</script>