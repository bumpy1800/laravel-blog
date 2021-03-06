<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Post extends Authenticatable
{
    use HasFactory;
    use Searchable;

    protected $table = 'post';
    protected $primaryKey = 'id';

    protected $fillable = [
        'title',
        'writer',
        'content',
        'photo_path',
    ];
    public function comment()
    {
        return $this->hasMany('App\Models\Comment','post_id');
    }

}
