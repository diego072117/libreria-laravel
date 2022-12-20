<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\Categorie\CreateCategorieRequest;
use App\Http\Requests\Categorie\UpdateCategorieRequest;

class CategorieController extends Controller
{
    public function getAllCategories(){
      
        $categories = Category::get();
        return response()->json(['categories' => $categories],200);

    }

    public function getAnCategorie(Category $categorie){

        return response()->json(['categorie' => $categorie],200);

    }

    public function createCategorie(CreateCategorieRequest $request){

        $categorie = new Category($request->all());
        $categorie->save();
        return response()->json(['categorie' => $categorie],201);

    }

    public function updateCategories(Category $categorie, UpdateCategorieRequest $request){

        
        $categorie->update($request->all());
        return response()->json(['categorie' => $categorie->refresh()],201);

    }

    public function deleteCategories(Category $categorie){

     
        $categorie->delete();
        return response()->json([],204);

    }

}
