<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;
use App\Http\Requests\Author\CreateAuthorRequest;
use App\Http\Requests\Author\UpdateAuthorRequest;

class AuthorController extends Controller
{
    public function getAllAuthors(){
      
        $authors = Author::get();
        return response()->json(['authors' => $authors],200);

    }

    public function getAnAuthor(Author $author){

        return response()->json(['authors' => $author],200);

    }

    public function createAuthor(CreateAuthorRequest $request){

        $author = new Author($request->all());
        $author->save();
        return response()->json(['author' => $author],201);

    }

    public function updateAuthors(Author $author, UpdateAuthorRequest $request){

        
        $author->update($request->all());
        return response()->json(['author' => $author->refresh()],201);

    }

    public function deleteAuthors(Author $author){

     
        $author->delete();
        return response()->json([],204);

    }

}
