<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Admin extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'admin';
    protected $fillable = [
        'id',
        'user_id',
        'nama',
        'telepon',
        'foto',
    ];

    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
    ];
}
