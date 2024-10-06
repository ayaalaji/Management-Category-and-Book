<?php

namespace App\Http\Requests\Book;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check() && Auth::user()->role == 'admin';
    }

    public function prepareForValidation()
    {
        $this->merge([
            'title' =>ucwords($this->input('title')),
            'author' =>ucwords($this->input('author')),
        ]);
        
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' =>'required|string|min:3|max:100',
            'author' =>'required|string|min:3|max:100',
            'published_at' =>'required|date_format:d-m-Y',
            'category_id' =>'required|integer|exists:categories,id',
        ];
    }
}
