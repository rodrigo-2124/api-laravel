<?php

namespace App\Models;

use App\Traits\ApiTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory, ApiTrait;

    //el atributo 'status' de posts
    const BORRADOR= 1;
    const PUBLICADO= 2;

    protected $fillable= [
        'name',
        'slug',
        'extract',
        'body',
        'status',
        'category_id',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    //relacion polimorfica
    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}
