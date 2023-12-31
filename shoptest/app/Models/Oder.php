<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Oder extends Model
{
    use HasFactory;
    protected $table ='oder';
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
    public function invoice()
    {
        return $this->belongsTo(Invoice::class, 'invoice_id'); 
    }
}
