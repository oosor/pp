<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string $name
 * */
class Category extends Model
{

    public function entities()
    {
        return $this->hasMany(Entity::class);
    }

}
