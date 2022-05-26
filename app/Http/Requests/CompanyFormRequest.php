<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyFormRequest extends FormRequest
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
            'company_name' => 'required|max:20',
            'street_address' => 'required',
            'representative_name' => 'required|max:20',
        ];
    }

    public function attributes()
    {
    return [
            'company_name' => '会社名',
            'street_address' => '住所',
            'representative_name' => '代表者名',
    ];
    }
}
