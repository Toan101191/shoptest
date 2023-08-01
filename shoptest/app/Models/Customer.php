<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;

class Customer extends Model implements Authenticatable
{
    use AuthenticableTrait;
    use HasFactory;
    protected $table ='customer';
    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
        
    }

}
