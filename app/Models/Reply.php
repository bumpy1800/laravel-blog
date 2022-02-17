<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    use HasFactory;

    protected $table = 'reply';
    protected $primaryKey = 'id';

    protected $fillable = [
        'content',
        'writer',
        'comment_id',
    ];

    public function comment()
    {
        return $this->belongsTo('App\Models\Comment','id');
    }
}
