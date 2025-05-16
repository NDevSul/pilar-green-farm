<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SeasonalCollection extends Model
{
    protected $fillable = ['name', 'slug', 'image', 'description'];
}