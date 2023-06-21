<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SearchSuggestionGeneraleRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'mot_cles' => 'string|nullable',
            'type' => 'string|nullable',
            'date_ajout' => 'date|nullable',
        ];
    }
}
