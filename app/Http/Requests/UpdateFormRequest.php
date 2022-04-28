<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'product_name' => 'required|max:20',
            'price' => 'required',
            'comment' => 'required',
            'stack' => 'required',
            // 'img_path' => 'required',
        ];
    }
    public function attributes()
    {
    return [
            'product_name' => '商品名',
            'price' => '価格',
            'comment' => 'コメント',
            'stack' => '在庫',
            // 'img_path' => '商品画像',
    ];
    }
}
