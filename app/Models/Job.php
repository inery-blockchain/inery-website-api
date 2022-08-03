<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Job extends Model
{
    use HasFactory;

    protected $fillable = ['category_id', 'name', 'inery_description', 'description', 'location', 'slug', 'job_requiretments', 'type', 'level', 'department', 'salary', 'position_description'];

    protected $hidden = ['id'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    protected $casts = [
        'name' => 'string',
        'description' => 'string',
        'inery_description' => 'string',
        'location' => 'string',
        'job_requiretments' => 'string',
        'position_description' => 'string',
        'type' => 'string',
        'level' => 'string',
        'slug' => 'string',
        'salary' => 'string',
        'department' => 'string',
        'category_id' => 'integer',
        'created_at'  => 'date:d-m-Y H:00',
        'updated_at' => 'date:d-m-Y H:00',
    ];

    // public function getNameAttribute($value)
    // {
    //     return ucwords($value);
    // }

    // public function setNameAttribute($value)
    // {
    //     $this->attributes['name'] = ucfirst(strtolower($value));
    // }

    public function getLocationAttribute($value)
    {
        return ucwords($value);
    }

    public function setLocationAttribute($value)
    {
        $this->attributes['location'] = ucwords($value) ?? 'Remote';
    }

    public function getLevelAttribute($value)
    {
        return ucwords($value);
    }

    public function getTypeAttribute($value)
    {
        return ucwords($value);
    }
}
