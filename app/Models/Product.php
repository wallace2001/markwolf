<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'description',
        'size_id',
        'image',
        'category_id'
    ];

    public function category(){
        return $this->hasOne(Category::class, foreignKey: "name", localKey: "category_id");
    }
    public function size(){
        return $this->hasOne(Size::class, foreignKey: "size", localKey: "size_id");
    }
}
