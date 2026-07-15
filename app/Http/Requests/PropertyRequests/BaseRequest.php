<?php

namespace App\Http\Requests\PropertyRequests;

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
            'user_id' => [
                'bail',
                'required',
                Rule::exists('users', 'id')->where(function ($query) {
                    $query->where('role', UserRole::HOST)->where('status', Status::ACTIVE);
                })
            ],
            'category_id' => [
                'bail',
                'required',
                Rule::exists('categories', 'id')->where(function ($query) {
                    $query->where('status', Status::ACTIVE);
                })
            ],
            'name' => ['bail', 'required', 'min:3', 'max:100'],
            'slug' => ['bail', 'nullable', 'min:3', 'alpha_dash'],
            'address' => ['bail', 'required', 'min:3', 'max:100'],
            'city' => ['bail', 'required', 'min:3', 'max:50'],
            'country' => ['bail', 'required', Rule::in(config('countries.list'))],
            'price' => ['bail', 'required', 'numeric', 'min:0'],
            'thumbnail' => ['bail', 'nullable', 'image', 'max:2048'],
            'status' => ['bail', 'required', Rule::enum(Status::class)]
        ];
    }
}
