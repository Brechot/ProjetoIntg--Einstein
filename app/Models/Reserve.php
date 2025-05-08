<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reserve extends Model
{
    use HasFactory;

    public $table = 'reserves';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id', 'id');
    }

    public function laboratory()
    {
        return $this->belongsTo(Laboratory::class,'laboratory_id', 'id');
    }

    public function discipline()
    {
        return $this->belongsTo(Discipline::class,'discipline_id', 'id');
    }
}
