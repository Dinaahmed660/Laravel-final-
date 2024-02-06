<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Car extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
    'Title',
    'Content',
    'Luggage',
    'Doors',
    'Passangers',
    'Price',
    'Active',
    'image',
    'category_id',
    ];
    public function category(){
        return $this->belongsTo(Category::class);
    }
}
