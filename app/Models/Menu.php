<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;
    public $timestamps=false;
    public function category(){
        return $this->belongsTo(Category::class);
    }
    public $fillable = [
        'category_id',
        'title',
    ];
}
