<?php

namespace App\Models;

use App\Models\Job;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $table = 'category';

    protected $fillable = ['name', 'image', 'slug'];

    // protected $hidden = ['id'];

    protected $casts = [
        'name' => 'string',
        'image' => 'string',
        'created_at'  => 'date:d-m-Y H:00',
        'updated_at' => 'date:d-m-Y H:00',
    ];

    public function jobs()
    {
        return $this->hasMany(Job::class);
    }

    public function getNameAttribute($value)
    {
        return ucwords($value);
    }

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = ucfirst($value);
    }
}
