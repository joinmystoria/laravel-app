<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Name extends Model
{
    use HasFactory;

    protected $table = 'name';

    protected $fillable = ['first_name', 'last_name'];

    public $timestamps = false;

}
