<?php

namespace App\Http\Requests\UserRequests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Validation\Rule;

class UpdateRequest extends BaseRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return array_merge($this->commonRules(), [
            'email' => [
                'bail',
                'required',
                'email',
                'min:3',
                'max:50',
                Rule::unique('users')->ignore($this->route('user')),
            ],

            'password' => [
                'bail',
                'nullable',
                'min:8',
                'confirmed',
            ],
        ]);
    }
}
