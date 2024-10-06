<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable =[
        'name',
        'description'
    ];
    /**
     * this is relation between Category and Book
     * the relation is one to many
     * one Category hasMany Book
     */
    public function books()
    {
        return $this->hasMany(Book::class);
    }
}
