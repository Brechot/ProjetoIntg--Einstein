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

    public function laboratory()
    {
        return $this->belongsToMany(Laboratory::class);
    }

    public function Discipline()
    {
        return $this->belongsToMany(Discipline::class);
    }

}
