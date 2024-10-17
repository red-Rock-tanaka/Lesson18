<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['post', 'user_id'];

    // タイムスタンプを自動的に管理するように設定
    public $timestamps = true;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
