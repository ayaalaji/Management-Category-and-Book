<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable =[
        'title',
        'author',
        'published_at',
        'is_active',
        'category_id',
    ];
    /**
     *this is the relation between Book and Category
     * the relation is one to many
     * many Book belongsTo one category
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

}
