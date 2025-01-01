<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $primaryKey = 'categoryId';

    protected $fillable = ['name', 'status', 'parentId'];

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parentId');
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parentId');
    }
}
