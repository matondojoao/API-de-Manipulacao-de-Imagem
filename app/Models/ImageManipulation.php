<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImageManipulation extends Model
{
    use HasFactory;

    protected $table='image_manipulations';

    const TYPE_RESIZE='resize';

    protected $fillable=['name','path','type','output_path','data','album_id','user_id'];
}
