<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'user_id',
        'title',
        'price',
        'brand',
        'description',
        'image_path',
        'condition',
        'stock',
        'detail',
        'is_deleted',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function scopeKeywordSearch($query, $keyword)
    {
        if (!empty($keyword)) {
            $query->where('title', 'LIKE', '%'.$keyword.'%')
                ->orWhere('brand', 'LIKE', '%'.$keyword.'%')
                ->orWhere('description', 'LIKE', '%'.$keyword.'%')
                ->orWhere('price', 'LIKE', '%'.$keyword.'%');
        }
    }

}
