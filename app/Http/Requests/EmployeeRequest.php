<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Validator;

class EmployeeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function prepareForValidation(): void {
        if (empty($this->all())) {
            throw new HttpResponseException(response()->json(['error_message' => "Invalid JSON body passed"]));
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        if ($this->method() == 'GET') {
            return [
                'firstname' => 'string',
                'lastname' => 'string',
                'email' => 'string',
                'department_id' => 'integer'
            ];
        }
        if ($this->method() === 'POST') {
            return [
                'firstname' => 'required|string|max:255',
                'lastname' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:employees',
                'department_id' => 'required|integer',
                'contact_numbers' => 'required|array',
                'contact_numbers.*.contact_number' => 'required|string',
                'addresses' => 'required|array',
                'addresses.*.address' => 'required|string',
                'addresses.*.city' => 'required|string',
                'addresses.*.state' => 'required|string',
                'addresses.*.pin_code' => 'required|string'
            ];
        }
        if ($this->method() === 'PUT') {
            return [
                'firstname' => 'string|max:255',
                'lastname' => 'string|max:255',
                'department_id' => 'required|integer',
                'contact_numbers' => 'array',
                'contact_numbers.*.contact_number' => 'numeric',
                'addresses' => 'array',
                'addresses.*.address' => 'string',
                'addresses.*.city' => 'string',
                'addresses.*.state' => 'string',
                'addresses.*.pin_code' => 'string'
            ];
        }
    }

    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator) {
        $errors = $validator->errors();
        $response = response()->json([
            'error_message' => 'Invalid data send',
            'details' => $errors->messages(),
        ], 422);

        throw new HttpResponseException($response);
    }

}
