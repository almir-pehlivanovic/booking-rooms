<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\Sluggable;


class Room extends Model
{
    use Sluggable;
    use SoftDeletes;

    protected $fillable = ['name', 'slug', 'capacity', 'description', 'hourly_rate'];

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function events()
    {
        return $this->hasMany(Event::class);
    }
}
