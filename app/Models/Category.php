<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Category extends Model
{
    use HasFactory;
    public $timestamps=false;
    public function menus()
    {
        return $this->hasMany(Menu::class);
    }
    public function articles()
    {
        return $this->hasMany(Article::class);
    }
    public $fillable = [
        'name',
        'type',
    ];
}
