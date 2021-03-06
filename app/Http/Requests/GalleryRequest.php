<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GalleryRequest extends FormRequest
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
            'kursus_id' => 'required|integer|exists:kursus,id',
            'image'     => 'sometimes|nullable|image|mimes:jpeg,jpg,png,bmp'
        ];
    }
}
