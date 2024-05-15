<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Timses extends Model
{
  use HasFactory;

  protected $table = 'users';
  protected $fillable = ['kelurahan_id', 'name', 'no_tlp', 'alamat', 'email', 'password'];
  protected $hidden = ['password', 'remember_token'];

  public function kelurahan()
  {
    return $this->belongsTo(Kelurahan::class);
  }
}
