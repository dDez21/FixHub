<?php    

namespace App\Models;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;

class Tech extends Model{
    
    protected $table = 'tech';

    protected $fillable = ['user_id','center_id','birth_date'];

    //relazione con utente (1:1)
    public function user()
    {
        return $this->belongsTo(User::class);
    }


    //relazione con centro (N:1)
    public function center()
    {
        return $this->belongsTo(Center::class);
    }

    
    //relazione con categorie (N:N)
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_tech');
    }
}