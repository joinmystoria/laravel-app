<?php

namespace App\Models;  // ✅ Correct namespace (uppercase "A")

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model {
    use HasFactory;

    protected $table = 'customers';
    protected $fillable = ['first_name', 'last_name'];
}
