<?php

namespace App\Http\Requests\Reminder;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return !empty(Auth::user()->id);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => [
                'required',
                'max:32'
            ],
            'color' => [
                'required',
                'regex:/^#[0-9A-Fa-f]{6}$/'
            ],
            'date' => [
                'required',
                'date'
            ],
            'regularity' => [
                'required',
                'in:once,everyday,monthly,yearly'
            ]
        ];
    }

}
