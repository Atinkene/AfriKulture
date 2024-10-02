<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class creerFormPartieImage extends FormRequest
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
            'type' => 'required|string|max:255',
            'description' => 'required|string|max:2500',
            'niveau' => 'required|string|max:255',
            'joueurAnonyme' => 'boolean',
            'date' => 'required|date|after_or_equal:today',
            'debut' => 'required|date_format:H:i',
            'duree' => 'required|integer|min:1',
            'questions.*.libelle' => 'required|file|max:2048', // Exemple de validation pour un fichier image jusqu'à 2 Mo
            'questions.*.points' => 'required|integer|min:1',
            'propositions' => 'required|array',
            'propositions.*.*' => 'required|string|max:255',
        ];
    }
}
