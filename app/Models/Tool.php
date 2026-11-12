<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tool extends Model
{
    protected $fillable = [
        'name',
        'description',
        'category_id',
        'is_active',
        'stock',
        'condition',
        'code',
    ];
    public function category(){
        return $this->belongsTo(Category::class);
    }
}