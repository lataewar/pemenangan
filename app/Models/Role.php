<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
  use HasFactory;

  protected $fillable = ['name', 'desc'];

  public function users()
  {
    return $this->hasMany(User::class);
  }

  public function menus()
  {
    return $this->belongsToMany(Menu::class);
  }
}
