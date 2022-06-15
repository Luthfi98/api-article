<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'content',
        'category',
        'status',
    ];
    protected $primaryKey = 'id';
    protected $table = "posts";
    public $timestamps = false; 
    


}
