<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function user(Request $request)
    {
        return User::find($request->user()->id);
    }
    public function menu(Request $request)
    {
        return Menu::where("user_id",$request->user()->id)->first();
    }
    public function updateMenu(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:menus,name,' . $id,
            'discount' => 'required|numeric|between:0,100',
        ]);
        $menu= Menu::find($id);
        if($menu){
            $menu->update($validated);
        }
        return $menu;

    }
}
