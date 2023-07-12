<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;
    protected $table ='new';
    public function customer()
    {
        return $this->belongsTo(Role::class, 'customer_id');
    }
}