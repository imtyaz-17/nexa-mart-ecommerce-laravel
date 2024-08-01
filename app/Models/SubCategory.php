<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;

    // Each Subcategory belongs to one Category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
