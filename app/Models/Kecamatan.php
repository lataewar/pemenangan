<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Model
{
  use HasFactory;

  protected $fillable = ['name', 'kabupaten_id'];

  public function kabupaten()
  {
    return $this->belongsTo(Kabupaten::class);
  }

  public function kelurahans()
  {
    return $this->hasMany(Kelurahan::class);
  }
}
