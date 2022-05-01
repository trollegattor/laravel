<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;
    public const ARTICLE_AUTHOR=[
        'ADMIN'=>'admin',
        'USER'=>'user'
    ];

    /**
     * @var string[]
     */
    public $fillable = [
        'category_id',
        'title',
        'content',
        'author',
    ];
    /**
     * @var string[]
     */
    protected $dates = [
        'created_at',
        'updated_at',
    ];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }


}
