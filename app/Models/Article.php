<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;
    public function category(){
        return $this->belongsTo(Category::class);
    }
    public $fillable = [
        'category_id',
        'title',
        'content',
        'author',
    ];
    protected $dates=[
        'created_at',
        'updated_at',
    ];

}
