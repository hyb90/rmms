<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCategoryRequest;
use App\Models\Category;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function myCategories()
    {
        $categories = Category::where("menu_id",Auth::user()->menu->id)->where("parent_id",null)->with("subCategories","items")->get();
        return $categories;
    }

    // to use in create new category parent drop list
    public function availableParentCategories()
    {
        $categories = Category::where("menu_id",Auth::user()->menu->id)->whereNot("depth",4)->whereNot("child_type","item")->get();
        return $categories;
    }

    // to use in create new Item parent drop list
    public function availableItemCategories()
    {
        $categories = Category::where("menu_id",Auth::user()->menu->id)->where("child_type","item")->get();
        return $categories;
    }

    // to save new category
    public function store(CreateCategoryRequest $request)
    {
        $depth=0;
        $parent=Category::find($request->parent_id);
        if($parent!=null){
            $depth=$parent->depth+1;
        }
        $data=array_merge($request->validated(),[
            "depth"=>$depth,
            "discount"=>$request->discount==null?0:$request->discount,
            "code"=>\Str::Slug($request->name),
            "menu_id"=>Auth::user()->menu->id
        ]);
        return Category::create(
            $data
        );
    }

    // to delete existed category
    public function delete($id){
        $category=Category::findOrFail($id);
        $category->delete();
        return response("success",200);
    }

    //todo add update category function
}
