<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kabupaten extends Model
{
  use HasFactory;

  protected $fillable = ['name', 'status', 'jumlah_dpt'];

  public function kecamatans()
  {
    return $this->hasMany(Kecamatan::class);
  }

  public function kelurahans()
  {
    return $this->hasManyThrough(Kelurahan::class, Kecamatan::class);
  }
}
