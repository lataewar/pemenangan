<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tps extends Model
{
  use HasFactory;

  protected $fillable = ['kelurahan_id', 'name', 'alamat', 'desc'];

  public function kelurahan()
  {
    return $this->belongsTo(Kelurahan::class);
  }

  public function dpts()
  {
    return $this->hasMany(Dpt::class);
  }

  public function pemilu()
  {
    return $this->hasOne(Pemilu::class);
  }
}
