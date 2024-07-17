<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function member()
    {
        return $this->belongsTo(Member::class,'id_member','id');
    }

    public function package()
    {
        return $this->belongsTo(Package::class,'id_package','id');
    }
}
