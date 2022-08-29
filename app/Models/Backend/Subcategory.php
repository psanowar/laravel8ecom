<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    use HasFactory;
    protected $fillable = [ 
        'catId',
        'subcatName',
        'slug',
        'des',
        'img',
        'status'
    ];
}
