<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vehicle extends Model
{
    use HasFactory, Sluggable, SoftDeletes;

    protected $fillable = [
        'vehicle_name',
        'number_plate',
        'slug',
        'picture',
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'number_plate'
            ]
        ];
    }

    /**
     * The categories that belong to the Vehicle
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'vehicle_category', 'vehicle_id', 'category_id');
    }

}
