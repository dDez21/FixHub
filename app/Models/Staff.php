<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;


class Staff extends Model {
  protected $table = 'staff';
  protected $fillable = ['user_id','center_id'];

  public function user() { return $this->belongsTo(User::class); }

  public function categories(){
        return $this->belongsToMany(Category::class, 'category_staff');
  }
}