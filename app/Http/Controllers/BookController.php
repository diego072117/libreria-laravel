<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\Book\CreateBookRequest;
use App\Http\Requests\Book\UpdateBookRequest;



class BookController extends Controller
{


    public function getAllBooks(){
      
        $books = Book::with('Author')->get();
        return response()->json(['books' => $books],200);

    }
    

    public function getAnBook(Book $book){

        $book->load('Author', 'Category');
        return response()->json(['book' => $book],200);

    }

    public function createBook(CreateBookRequest $request){
 
        $book = new Book($request->all());
        $this->uploadImages($request, $book);
        $book->save();
        return response()->json(['book' => $book->refresh()->load('Author', 'Category')],201);

    }

    public function updateBooks(Book $book, UpdateBookRequest $request){

        $requestAll = $request->all();  
        $this->uploadImages($request, $book);
        $requestAll['image'] =$book->image;
        $book->update($requestAll);
        return response()->json(['book' => $book->refresh()->load('Author', 'Category')],201);

    }

    public function deleteBooks(Book $book){

     
        $book->delete();
        return response()->json([],204);

    }

    public function showHomeWithBooks(){

        $books = $this->getAllBooks()->original['books'];
        return view('index',compact('books')); 

    }

    public function showBooks(){

        return view('books.index'); 

    }

    private function uploadImages($request, &$book)
    {
        if (!isset($request->image)) return;
        $random = Str::random(8);
        $image_name = "{$random}.{$request->image->clientExtension()}";
        $request->image->move(storage_path('app/public/images'), $image_name);
        $book->image = $image_name;

        $image_name;
    }

    
}
