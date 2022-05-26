<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    // use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'product_name',
        'price',
        'stack',
        'comment',
        'img_path',
    ];

    public function campany()
    {
        return $this->hasOne(Campany::class);
    }


}
