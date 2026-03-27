<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateMissionRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'string|max:255',
            "description" => 'string',
            'budget' => "float",
            'duration' => 'string|max:255',
            'technologies' => 'required|string',
            'category' => 'required|string|max:255'

        ];
    }



    /*         public function message()
    {
        return [
            'email.required' => 'Email is a required input.',
            'email.max' => 'Email needs to be less than 255 charachters.',

            'password.required' => 'Password is a required input.',
            'password.max' => 'Password needs to be less than 255 charachters.',

        ];
    } */

    public function failedValidation(Validator $validator)
    {
        $errors = $validator->errors();
        $response = response()->json([
            'message' => 'Invalid data send',
            'details' => $errors->messages(),
        ], 422);

        throw new HttpResponseException($response);
    }
}
