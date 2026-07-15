<?php

namespace App\Http\Requests\UserRequests;

use App\Enums\Status;
use App\Enums\UserRole;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BaseRequest extends FormRequest
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
    public function commonRules(): array
    {
        return [
            'name' => ['bail', 'required', 'min:3', 'max:200'],
            'role' => ['bail', 'required', Rule::enum(UserRole::class)],
            'image' => ['bail', 'nullable', 'image', 'max:2048'],
            'status' => ['bail', 'required', Rule::enum(Status::class)],
        ];
    }
}
