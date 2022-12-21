{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <h1>Hola Mundo</h1>
</div>
@endsection --}}


{{-- <x-app title="ci" :sum="2+3"> --}}
<x-app title="ci">
    
    <section class="d-flex justify-content-center flex-wrap">

        @foreach ($books as $book)
        
        <div class="card mx-3 my-3" style="width: 18rem;">
            <img src="https://i.pinimg.com/564x/df/d7/96/dfd7966a504c43881b4b874d2ec6ae8d.jpg" class="card-img-top" alt="...">
            <div class="card-body">
            <h5 class="card-title">{{ $book->title }}</h5>
            <p class="card-text">{{ $book->description }}</p>
            <a href="#" class="btn btn-primary">Lend</a>
            </div>
        </div> 

    @endforeach

    </section>



</x-app>

