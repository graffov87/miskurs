<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'short_content',
        'url'
    ];

    public function categories()
    {

        return $this->belongstoMany(Category::class, 'post_categories', 'post_id', 'category_id');
    }

    public function tags()
    {

        return $this->belongstoMany(Tag::class, 'post_tags', 'post_id', 'tag_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function materials()
    {

        return $this->belongstoMany(Material::class, 'post_materials', 'post_id', 'material_id');
    }

    protected static function boot(): void
    {
        parent::boot();
        //
        self::creating(function ($post) {
            $post->user_id = auth()->id();
        });
    }

    public function getRouteKeyName()
    {
        return 'url';
    }
}
