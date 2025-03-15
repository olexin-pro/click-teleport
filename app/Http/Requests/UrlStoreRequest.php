<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UrlStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth('sanctum')->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'url' => 'required|url',
            'key' => 'nullable|string|regex:/^[a-z0-9_-]+$/i',
            'single_use' => 'nullable|boolean',
            'forward_query' => 'nullable|boolean',
            'redirect_code' => 'nullable|in:302,301',
            'activated_at' => 'nullable|date',
            'deactivated_at' => 'nullable|date',
        ];
    }
}
