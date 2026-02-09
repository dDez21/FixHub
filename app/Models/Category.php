<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';

    protected $fillable = ['name'];

    
    //relazione con tecnici (N:N)
    public function users()
    {
        return $this->belongsToMany(User::class, 'category_user');
    }

    //relazione con prodotti (1:N)
    public function products()
    {
        return $this->hasMany(\App\Models\Product::class);
    }

}
