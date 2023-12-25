<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $table = 'profiles';
    protected $fillable = ['dob', 'bio', 'avatar','first_name','last_name'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}