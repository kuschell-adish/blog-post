<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $routeName = $this->route()->getName();

        if ($routeName === 'users.store') {
            return true;
        }

        if ($routeName === 'users.update') {
            return Auth::check() && Auth::id() === $this->route('user')->id;
        }

        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $routeName = $this->route()->getName();

        if ($routeName === 'users.store') {
            return [
                'first_name' => ['required', 'min:2', 'max:50'], 
                'last_name' => ['required', 'min:2', 'max:50'],
                'email' => ['required', 'email', 'unique:users,email'], 
                'password' => ['required', 'string', 'min:8', 'regex:/[a-z]/', 'regex:/[A-Z]/', 'regex:/[0-9]/', 'regex:/[@$!%*#?&]/'],
                'photo' => ['nullable', 'image', 'mimes:jpeg,png', 'max:2048'] 
            ]; 
        }

        if ($routeName === 'users.update') {
            $rules = [
                'first_name' => ['required', 'min:2', 'max:50'],
                'last_name' => ['required', 'min:2', 'max:50'],
                'email' => ['required', 'email', 'unique:users,email,' . $this->route('user')->id],
                'photo' => ['nullable', 'image', 'mimes:jpeg,png', 'max:2048']
            ];

            if ($this->filled('password')) {
                $rules['password'] = [
                    'required',
                    'string',
                    'min:8',
                    'regex:/[a-z]/',
                    'regex:/[A-Z]/',
                    'regex:/[0-9]/',
                    'regex:/[@$!%*#?&]/'
                ];
            }

            return $rules;
        }
        
    return [];
    }
}
