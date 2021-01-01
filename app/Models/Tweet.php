<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tweet extends Model
{
    use HasFactory;

    protected $fillable = ['tweet','file','user_id'];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
}
