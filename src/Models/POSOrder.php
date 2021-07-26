<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class POSOrder extends Model
{
    use HasFactory;
    protected $table = 'orders';
}
