<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Center extends Model
{
    use HasFactory;

    //dati centro
    protected $fillable = [
        'name','phone','email','country','region','provincia','city','address','civic'
        ];


    //relazione con tecnici (1:N)
    public function techs()
    {
        return $this->hasMany(Tech::class);
    }
}
