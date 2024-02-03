<?php

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\File;


class StoreProductPhotoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        if(!Auth::check()) {
            return false;
        }

        $user = Auth::user();
        if($user->hasPermissionTo("create products")) {
           return true; 
        }
        return false;
    }

        /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'product_id' => 'integer',
            'order' => 'integer',
            'photo' => [
                'required',
                File::image()->max(12 * 1024)
                // ->dimensions(
                //     Rule::dimensions()
                //         ->minWidth(500)
                //         ->minHeight(500)
                //         ->maxWidth(1000)
                //         ->maxHeight(1000))
                        ,
            ]
        ];
    }
}
