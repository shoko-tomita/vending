<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    // use HasFactory;
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


    // public function getCompanyNameById()
    // {
    // return DB::table('products')
    //         ->join('companies', 'products.company_id', '=', 'companies.id')
    //         ->get();
    // }

// return DB::table('posts')
//             ->join('users', function($join) {
//               $join->on('posts.user_id', 'users.id');
//             })
//             ->get();

}
