<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
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
        $userId = $this->route('id');
        return [
            'username' => 'required|string|max:255|' . Rule::unique('users', 'username')->ignore($userId),
            'email' => 'required|string|email|max:255|' . Rule::unique('users', 'email')->ignore($userId),
            'phone_number' => 'required|regex:/^[0-9]+$/|min:11|max:13',
            'address' => 'required|string',
            'status' => 'required',
            'major' => [
                'required',
                Rule::in([
                    'Rekayasa Perangkat Lunak',
                    'Teknik Komputer Jaringan',
                    'Teknik Elektronika Industri',
                    'Desain Komunikasi Visual',
                    'Desain Pemodelan dan Informasi Bangunan',
                    'Teknik Sepeda Motor',
                    'Teknik Kendaraan Ringan',
                ]),
            ],
        ];
    }
    
    public function messages(): array
    {
        return [
            'username.required' => 'Username is required.',
            'username.unique' => 'This username is already taken.',
            'email.required' => 'Email is required.',
            'email.email' => 'The email must be a valid email address.',
            'email.unique' => 'This email is already registered.',
            'phone_number.regex' => 'Phone Number is Only For Number.',
            'address.required' => 'Address is required.',
            'status.required' => 'Status is required.',
            'major.required' => 'Major is required.',
            'major.in' => 'Please select a valid major.',
        ];
    }
}
