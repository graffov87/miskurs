<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory;

    public function posts() {
        return $this->belongstoMany(Post::class, 'post_materials','material_id','post_id');
    }
}
