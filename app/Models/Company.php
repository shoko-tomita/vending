<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Company extends Model
{
    // use HasFactory;
    protected $fillable = [
        'company_name',
        'street_address',
        'representative_name',
    ];
    // public function campany()
    // {
    //     return $this->hasOne(Campany::class);
    // }
}
