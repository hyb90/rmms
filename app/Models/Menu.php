<?php

namespace App\Models;

use App\Http\Actions\CalculateTotalMenuPrice;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $fillable=["name","user_id","discount"];

    protected $appends = ['prices'];

    /**
     * Get the user that owns the menu.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(Item::class);
    }

    public function getPricesAttribute()
    {
        $data["discountPrice"]=0;
        $data["originalPrice"]=0;
        $items=Item::where("menu_id",$this->id)->get();
        foreach($items as $item){
            $data["discountPrice"]+=$item->discount_price;
            $data["originalPrice"]+=$item->price;
        }
        return $data;
    }


}
