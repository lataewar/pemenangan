<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelurahan extends Model
{
  use HasFactory;

  protected $fillable = ['name', 'kecamatan_id', 'status'];

  public function kecamatan()
  {
    return $this->belongsTo(Kecamatan::class);
  }

  public function tps()
  {
    return $this->hasMany(Tps::class);
  }

  public function dpt()
  {
    return $this->hasMany(Dpt::class);
  }

  public function timses()
  {
    return $this->hasMany(Timses::class);
  }
}
