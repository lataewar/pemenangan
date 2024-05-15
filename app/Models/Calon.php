<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calon extends Model
{
  use HasFactory;

  protected $fillable = ['name', 'no_urut', 'is_selected', 'desc'];

  public function pemilus()
  {
    return $this->belongsToMany(Pemilu::class)->withTimestamps()->withPivot(['suara']);
  }
}
