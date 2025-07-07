<?php

namespace App\Http\Requests\Movie;

use Illuminate\Foundation\Http\FormRequest;

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
        return [
            'mName' => ['required','string'],
            'date' => ['required','date'],
            'time' => ['required', 'integer', 'numeric'],
            'gID' => ['required']
        ];
    }

    public function messages()
    {
        return [
            'mName.required' => '映画名を入力してください',
            'date.required' => '公開日を入力してください',
            'time.required' => '上映時間を入力してください',
            'time.integer' => '上映時間は整数で入力してください',
            'gID.required' => '一つ以上ジャンルを選択してください'
        ];
    }

    public function mName(): string
    {
        return $this->input('mName');
    }

    public function mdate(): string
    {
        return $this->input('date');
    }

    public function mtime(): string
    {
        return $this->input('time');
    }

    public function mID(): int
    {
        return (int) $this->route('mID');
    }
}
