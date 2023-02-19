<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateItemRequest;
use App\Http\Requests\UpdateItemRequest;
use App\Http\Resources\ItemResource;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class ItemController extends Controller{

    // to save new item
    public function store(CreateItemRequest $request)
    {
        $data=array_merge($request->validated(),[
            "discount"=>$request->discount==null?0:$request->discount,
            "code"=>\Str::Slug($request->name),
            "menu_id"=>Auth::user()->menu->id
        ]);
        return Item::create(
            $data
        );
    }


   // to delete existed item
    public function delete($id)
    {
        $item=Item::findOrFail($id);
        $item->delete();

        return response("success", 200);
    }

    //todo add update item function
}
