<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Category extends Model
{
    use HasFactory;

    public const CATEGORY_TYPES = [
        'SINGLE' => 'single',
        'MULTI' => 'multiple',
    ];
    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var string[]
     */
    public $fillable = [
        'name',
        'type',
    ];

    public function menus()
    {
        return $this->hasMany(Menu::class);
    }

    public function articles()
    {
        return $this->hasMany(Article::class);
    }
}
