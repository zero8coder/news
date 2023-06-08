<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'no',
        'title',
        'content',
        'source',
        'url'
    ];

    const SOURCE_WEIBO = 1;

    public static $sourceMap = [
        self::SOURCE_WEIBO => '微博'
    ];
}
