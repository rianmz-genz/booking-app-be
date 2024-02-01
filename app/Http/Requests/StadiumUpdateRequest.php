<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class StadiumUpdateRequest extends FormRequest
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
            'name' => ['nullable', 'max:100'],
            'address' => ['nullable', 'max:300'],
            'phone' => ['nullable', 'max:100'],
            'description' => ['nullable'],
            'images' => ['nullable', 'array'],
            'open_at' => ['nullable'],
            'closed_at' => ['nullable'],
            'stadium_category_id' => ['nullable', Rule::exists('stadium_categories', 'id')],
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
