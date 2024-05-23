<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dish extends Model
{
    use HasFactory;
    protected $table = "user_dishes";
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'dish_email',
        'dish_image',
        'dish_name',
        'dish_description',
        'dish_ingredients',
        'dish_dir',
        'dish_time',
        'dish_yield'
    ];
    protected $casts = [
        'dish_ingredients' => 'array',
        'dish_dir' => 'array',
    ];
}
