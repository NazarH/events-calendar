<?php

namespace App\Http\Requests\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
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
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('users')
                    ->ignore(
                        basename(
                            parse_url(
                                $this->url(),
                                PHP_URL_PATH
                            )
                        )
                    ),
            ],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')
                    ->ignore(
                        basename(
                            parse_url(
                                $this->url(),
                                PHP_URL_PATH
                            )
                        )
                    ),
            ],
            'password' => [
                'nullable',
                'string',
                'min:8',
                'confirmed'
            ]
        ];
    }
}
