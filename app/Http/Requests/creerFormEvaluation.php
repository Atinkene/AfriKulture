<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class creerFormEvaluation extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nom' => 'required|string|max:255',
            'date' => 'required|date|after_or_equal:today',
            'debut' => 'required|date_format:H:i',
            'duree' => 'required|integer|min:1',
            'questions.*.libelle' => 'required|string|max:255', // Le champ 'libelle' de chaque question est requis
            'questions.*.points' => 'required|integer|min:1', // Le champ 'points' de chaque question est requis et doit être un entier positif
            'propositions' => 'required|array',
            'propositions.*.*' => 'required|string|max:255', 
        ];
    }
}