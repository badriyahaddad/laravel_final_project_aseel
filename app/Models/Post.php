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
public function admin(): BelongsTo
{
    return $this->belongsTo(Admin::class,'user_id');
}
}
