<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $collection = 'categories';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'user',
        'status',
        'priority',
        'parent_id',
    ];

}
