<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Software extends Model
{
    use HasFactory;

    public $table = 'software';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function laboratories()
    {
        return $this->belongsToMany(Laboratory::class, 'laboratory_software')
            ->withPivot('seen_at')
            ->withTimestamps();
    }

    public function disciplines()
    {
        return $this->belongsToMany(Discipline::class, 'discipline_software')
            ->withPivot('seen_at')
            ->withTimestamps();
    }

}
