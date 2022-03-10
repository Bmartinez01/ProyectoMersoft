<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estados extends Model
{
    protected $fillable =
    [
    'Estado',
    'Tipo',
    ];
    use HasFactory;
}
