<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserAddressRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'country' =>        '',
            'state' =>          '',
            'city' =>           '',
            'address' =>        'max:255',
            'postal_code' =>    'numeric',
            'phone' =>          'numeric',
            'details' =>         '',
        ];
    }
}
