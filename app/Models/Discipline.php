<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discipline extends Model
{
    use HasFactory;

    public $table = 'disciplines';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function softwares()
    {
        return $this->belongsToMany(Software::class);
    }

}
