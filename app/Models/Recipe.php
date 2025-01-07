<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['name', 'description', 'ingredients', 'image'];

    public function bookmarks()
    {
        return $this->hasMany(Bookmark::class);
    }
}
