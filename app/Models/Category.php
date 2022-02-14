<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory,sluggable;
    protected $table = "categories";
    protected $guarded = [];
    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'slug'
            ]
        ];
    }
    public function getIsActiveAttribute($is_active)
    {
        return $is_active ? 'فعال' : 'غیرفعال';
    }
    public function parent()
    {
        return $this->belongsTo(Category::class , 'parent_id');
    }
    public function children()
    {
        return $this->hasMany(Category::class , 'parent_id');
    }
    public function attributes()
    {
        return $this->belongsToMany(Attribute::class , 'attribute_category');
    }
    public function products()
    {
        return $this->HasMany(Product::class);
    }

}
