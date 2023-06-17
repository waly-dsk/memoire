<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SearchAbonneRequest extends FormRequest
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
            'entite' => ['string', 'nullable'],
            'option' => ['string', 'nullable'],
            'matricule' => ['numeric', 'gte:0', 'nullable'],
            'nom' => ['string', 'nullable'],
        ];
    }
}
