<?php    

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model{
    protected $fillable = [
        'name','photo','category_id','description',
        'use_techniques','installation'
    ];

    //relazione con categoria (N:1)
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    //relazione con malfunzionamenti (1:N)
    public function malfunctions()
{
    return $this->hasMany(Malfunction::class);
}
}