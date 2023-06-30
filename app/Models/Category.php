<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Traits\ApiTrait;

class Category extends Model
{
    use HasFactory, ApiTrait;

    protected $fillable= [
        'name',
        'slug'
    ];

    //permite incluir los nombres de las relaciones en el endpoint que se pueden utilizar en el Query Scope
    protected $allowIncluded= [
        'posts',
        'posts.user'
    ];

    protected $allowFilter= [
        'id',
        'name',
        'slug'
    ];

    protected $allowSort= [
        'name'
    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
    
  
}
