<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use App\Http\Requests\Book\CreateBookRequest;
use App\Http\Requests\Book\UpdateBookRequest;



class BookController extends Controller
{

    public function getAllBooks(){
      
        $books = Book::get();
        return response()->json(['books' => $books],200);

    }

    public function getAnBook(Book $book){

        return response()->json(['book' => $book],200);

    }

    public function createBook(CreateBookRequest $request){

        $book = new Book($request->all());
        $book->save();
        return response()->json(['book' => $book],201);

    }

    public function updateBooks(Book $book, UpdateBookRequest $request){

        
        $book->update($request->all());
        return response()->json(['book' => $book->refresh()],201);

    }

    public function deleteBooks(Book $book){

     
        $book->delete();
        return response()->json([],204);

    }

    public function showHomeWithBooks(){

        $books = $this->getAllBooks()->original['books'];
        return view('index',compact('books')); 

    }

    
}
