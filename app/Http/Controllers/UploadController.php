<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function index()
    {
        // アップロードされた画像一覧を表示する
        $images = Product::all();
        return view('upload.store', compact('upload'));
    }

}
