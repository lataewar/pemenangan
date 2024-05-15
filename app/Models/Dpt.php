<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dpt extends Model
{
  use HasFactory;

  protected $fillable = ['kelurahan_id', 'tps_id', 'name', 'nik', 'timses_id', 'no_tlp', 'alamat', 'desc'];

  public function kelurahan()
  {
    return $this->belongsTo(Kelurahan::class);
  }

  public function tps()
  {
    return $this->belongsTo(Tps::class);
  }
}
