<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Center extends Model
{
    use HasFactory;

    //dati centro
    protected $fillable = [
        'name','phone','email','region_id','province_id','city_id','street','civic'
        ];


    //relazione con tecnici (1:N)
    public function techs()
    {
        return $this->hasMany(Tech::class);
    }

    public function region()   { return $this->belongsTo(Region::class, 'region_id'); }
    public function province() { return $this->belongsTo(Province::class, 'province_id'); }
    public function city()     { return $this->belongsTo(City::class, 'city_id'); }
}
