<?php    

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Malfunction extends Model{
    protected $fillable = ['name','description','solution','product_id'];

    //relazione con prodotto (N:1)
    public function product()
    {
        return $this->belongsTo(\App\Models\Product::class);
    }
}