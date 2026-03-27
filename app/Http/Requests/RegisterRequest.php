<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class RegisterRequest extends FormRequest
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
        $rules = [
            'firstname' => 'required|max:255|string',
            'lastname' => 'required|max:255|string',
            'email' => 'required|max:255|string|unique:users,email',
            'password' => 'required|max:255|confirmed',
            'role' => 'required|string|in:freelancer,client',

        ];

        if ($this->input('role') == 'client') {
            $rules['enterprise'] = 'max:255|string';
            $rules['description'] = 'max:255|string';
        } else if ($this->input('role') == 'freelancer') {
            $rules['price'] = 'required|numeric|min:0';
            $rules['portfolio'] = 'max:255|string';
            $rules['availability'] = 'string|max:255';
            $rules['description'] = 'max:255|string';
            $rules['competences'] = 'string';
            $rules['technologies'] = 'string';
        }

        return $rules;
    }

    public function message()
    {
        return [
            'firstname.required' => 'Firstname is a required input.',
            'firstname.max' => 'Firstname needs to be less than 255 charachters.',

            'lastname.required' => 'Lastname is a required input.',
            'lastname.max' => 'Lastname needs to be less than 255 charachters.',

            'email.unique' => 'This email is already used',
            'email.required' => 'Email is a required input.',
            'email.max' => 'Email needs to be less than 255 charachters.',

            'password.required' => 'Password is a required input.',
            'password.max' => 'Password needs to be less than 255 charachters.',
            'password.confirmed' => 'Passwords are not compatible',

            'enterprise.string' => 'Enterprise needs to be a string',
            'enterprise.max' => 'Enterprise needs to be 255 charachters or less',

            'portfolio.string' => 'Portfolio link needs to be a string',
            'portfolio.max' => 'Portfolio link needs to be 255 charachters or less',

            'description.string' => 'Description needs to be a string',
            'description.max' => 'Description needs to be 255 charachters or less',

            'availability.string' => 'Availability needs to be a string',
            'availability.max' => 'Availability needs to be 255 charachters or less',

            'price.required' => 'Your Wage is required',
            'price.numeric' => 'Your wage needs to be a number',
            'price.min' => 'Your wage needs to be more than 0'



        ];
    }

    public function failedValidation(Validator $validator)
    {
        $errors = $validator->errors();
        $response = response()->json([
            "success" => false,
            'message' => 'Erreur de validation',
            'error' => $errors->messages(),
        ], 422);

        throw new HttpResponseException($response);
    }
}
