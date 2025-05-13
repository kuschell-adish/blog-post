<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $routeName = $this->route()->getName();

        if ($routeName === 'comments.store') {
            return [
                'comment' => ['required', 'string', 'min:3', 'max:150'], 
                'blog_id' => ['required', 'integer', 'exists:blogs,id'], 
            ]; 
        }

        if ($routeName === 'comments.update') {
            return [
                'comment' => ['required', 'string', 'min:3', 'max:150']
            ]; 
        }
    }
}
