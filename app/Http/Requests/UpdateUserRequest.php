<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            "name" => "required|min:3|max:20",
            "gender" => [
                'required',
                 Rule::in(['0', '1','2']),
             ],
            "bio" => "max:255",
            "profile" => "mimes:png,jpg",
            "cover_img"=> "mimes:png,jpg,gif",
            "livein"=>"required|min:3|max:255",
            "mobile" => "required|string|min:11|max:14",
        ];
    }
}
