<?php

namespace App\Http\Requests\CategoryRequests;

use App\Enums\Status;
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
            'slug' => ['bail', 'nullable', 'min:3', 'alpha_dash'],
            'status' => ['bail', 'required', Rule::enum(Status::class)]
        ];
    }
}
