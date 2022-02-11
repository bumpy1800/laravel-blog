<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $table = 'comment';
    protected $primaryKey = 'id';

    protected $fillable = [
        'content',
        'writer',
        'post_id',
        'comment_id',
    ];

    public function post()
    {
        return $this->belongsTo('App\Models\Post','id');
    }
}
