<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class StadiumCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'max:100'],
            'address' => ['required', 'max:300'],
            'phone' => ['required', 'max:100'],
            'description' => ['required'],
            'images' => ['required', 'array'],
            'open_at' => ['required'],
            'closed_at' => ['required'],
            'stadium_category_id' => ['required', Rule::exists('stadium_categories', 'id')],
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response([
            "status" => false,
            "message" => $validator->getMessageBag(),
            "code" => 400,
            "data" => null
        ], 400));
    }
}
