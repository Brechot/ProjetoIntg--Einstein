<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laboratory extends Model
{
    use HasFactory;

    public $table = 'laboratories';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function software()
    {
        return $this->belongsToMany(Software::class);
    }
}
