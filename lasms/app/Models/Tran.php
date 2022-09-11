<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tran extends Model
{
    use HasFactory;
    protected $fillable = ['from', 'to', 'amount', 'before_transaction', 'source', 'content','id_sms'];
}
