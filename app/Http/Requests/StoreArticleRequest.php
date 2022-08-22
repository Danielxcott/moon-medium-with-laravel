<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreArticleRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "title" => "required|min:3",
            "slug" => "required|min:3",
            "description" => "required",
            "excerpt" => "required|string|min:3",
            "thumbnail" => "mimes:png,jpg",
            "images.*" => "mimes:png,jpg",
        ]; 
    }
}
