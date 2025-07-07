<?php

namespace App\Http\Requests\Movie;

use Illuminate\Foundation\Http\FormRequest;

class GenreCreateRequest extends FormRequest
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
            'genreName' => ['required','string','unique:genres,genreName'],
        ];
    }

    public function messages()
    {
        return [
            'genreName.required' => 'ジャンル名を入力してください',
            'genreName.unique' => 'そのジャンルは既に存在しています',
        ];
    }
}
