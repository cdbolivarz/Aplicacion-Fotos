<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ImagexAlbum extends Model
{
	public $timestamps = false;
    protected $table = "IMAGEXALBUM";
    protected $fillable = ['idAlbum','idImage','orderNumber'];

    public function images()
    {
        return $this->hasMany('App\Image');
    }

    public function albums()
    {
        return $this->hasMany('App\Album');
    }

}
