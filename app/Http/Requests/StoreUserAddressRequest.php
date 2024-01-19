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
            'user_id' =>        'required|unique:users,id',
            'country' =>        'required',
            'state' =>          'required',
            'city' =>           'required',
            'address' =>        'required|max_digits:20',
            'postal_code' =>    'required|max_digits:15',
            'phone' =>          'required|max_digits:15',
            'details' =>         'required',
        ];
    }
}
