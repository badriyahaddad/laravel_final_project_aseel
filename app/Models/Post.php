<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    use HasFactory;
    protected $fillable= [
    'title',
    'content',
    'location',
    'image',
    'user_id',
    'category_id'
];
//Relationships
public function admin()
{
    return $this->belongsTo(Admin::class,'user_id');
}
public function catagory()
{
    return $this->belongsTo(Catagory::class,'category_id');
}
public function comments()
{
    return $this->hasMany(Comment::class);
}
public function Book()
{
    return $this->hasMany(Book::class);
}
}
