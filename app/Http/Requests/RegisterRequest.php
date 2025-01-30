<?php

    namespace App\Http\Requests;

    use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            return [
                'username' => 'required|string|max:255|unique:users,username',
                'email' => 'required|string|email|max:255|unique:users,email',
                'phone_number' => 'required|regex:/^[0-9]+$/|unique:users,phone_number|max:13|min:11',
                'address' => 'required|string',
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
                'password' => 'required|string|min:8|confirmed',
                'rolename' => 'required|string',
                'status' => 'required|string',
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
                'phone_number.unique' => 'This phone number is already taken.',
                'address.required' => 'Address is required.',
                'major.required' => 'Major is required.',
                'major.in' => 'Please select a valid major.',
                'password.required' => 'Password is required.',
                'password.min' => 'Password must be at least 8 characters.',
                'password.confirmed' => 'Passwords do not match.',
                'rolename.required' => 'Rolename is required.',
                'status.required' => 'Status is required.',
            ];
        }
    }
