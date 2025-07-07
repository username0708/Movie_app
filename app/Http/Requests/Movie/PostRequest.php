<?php

namespace App\Http\Requests\Movie;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
            'star' => ['required','integer'],
            'title' => ['required','string', 'max:50'],
            'content' => ['required','string']
        ];
    }

    public function messages()
    {
        return [
            'star.required' => '五段階評価を入力してください',
            'title.required' => 'タイトルを入力してください',
            'content.required' => '本文を入力してください',
        ];
    }

    public function star(): int
    {
        return $this->input('star');
    }
}
