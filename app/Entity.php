<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string $name
 * @property array $data
 * @property int $category_id
 * */
class Entity extends Model
{
    protected $casts = [
        'data' => 'json',
    ];


    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
