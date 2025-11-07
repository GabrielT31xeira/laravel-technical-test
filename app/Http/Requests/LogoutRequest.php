<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LogoutRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Apenas usuários autenticados podem fazer logout
        return auth()->check();
    }

    public function rules(): array
    {
        return [];
    }
}
