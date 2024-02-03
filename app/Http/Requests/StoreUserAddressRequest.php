<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserAddressRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'country' =>        'required',
            'state' =>          'required',
            'city' =>           'required',
            'address' =>        'required|max:255',
            'postal_code' =>    'required|numeric',
            'phone' =>          'required|numeric',
            'details' =>         'required',
        ];
    }
}
