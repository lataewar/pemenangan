<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Pemilu extends Model implements HasMedia
{
  use HasFactory, InteractsWithMedia;

  protected $fillable = ['tps_id', 'user_id', 'jml_dpt', 'jml_suara', 'jml_suara_batal', 'desc', 'foto'];

  public function tps()
  {
    return $this->belongsTo(Tps::class);
  }

  public function user()
  {
    return $this->belongsTo(User::class);
  }

  public function calons()
  {
    return $this->belongsToMany(Calon::class)->withTimestamps()->withPivot(['suara']);
  }

  public function registerMediaCollections(): void
  {
    $this
      ->addMediaCollection('pemilu_foto')
      ->singleFile()
      ->useDisk('public')
      ->useFallbackUrl(asset('/assets/media/error/no_image.jpg'))
      ->useFallbackPath(asset('/assets/media/error/no_image.jpg'));
  }

  public function registerMediaConversions(Media $media = null): void
  {
    $this->addMediaConversion('thumbnail')
      ->width(200)
      ->height(200);
    // ->sharpen(10);
  }

  public function getImage()
  {
    $file = $this->getMedia('pemilu_foto')->first();

    if ($file) {
      $file->url = $file->getUrl();
      $file->thumb = $file->getUrl('thumbnail');
    } else {
      $file = new \StdClass;
      $file->url = asset('/assets/media/error/no_image.jpg');
      $file->thumb = asset('/assets/media/error/no_image.jpg');
    }

    return $file;
  }
}
