<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Action extends Model
{
    use HasFactory;
    protected $table = 'actions';

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    public function post()
    {
        return $this->belongsTo(\App\Models\Post::class);
    }

}
