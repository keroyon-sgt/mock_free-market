<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'user_id',
        'item_id',
        'method',
        'postal_code',
        'address',
        'building',
        'price',
    ];

    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    public function item(){
        return $this->belongsTo('App\Models\Item');
    }
}
