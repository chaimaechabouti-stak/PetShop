<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddProductRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            'nom' => 'required|min:5',
            'description' => 'required|min:10',
            'prix' => 'required|numeric|min:0',
            'categorie' => 'required|min:5',
            'quantite' => 'required|integer|min:1',
            'image' => 'required|image|max:2048',
        ];
    }

    /**
     * Get custom error messages for validation rules.
     */
    public function messages(): array
    {
        return [
            'nom.required' => 'Le nom du produit est obligatoire.',
            'nom.min' => 'Le nom doit contenir au moins 5 caractères.',
            'description.required' => 'La description est obligatoire.',
            'description.min' => 'La description doit contenir au moins 10 caractères.',
            'prix.required' => 'Le prix est obligatoire.',
            'prix.numeric' => 'Le prix doit être un nombre.',
            'prix.min' => 'Le prix doit être positif.',
            'categorie.required' => 'La catégorie est obligatoire.',
            'categorie.min' => 'La catégorie doit contenir au moins 5 caractères.',
            'quantite.required' => 'La quantité est obligatoire.',
            'quantite.integer' => 'La quantité doit être un nombre entier.',
            'quantite.min' => 'La quantité doit être au moins 1.',
            'image.required' => 'Veuillez sélectionner une image.',
            'image.image' => 'Le fichier doit être une image (jpeg, png, etc.).',
            'image.max' => 'L\'image ne doit pas dépasser 2 Mo.',
        ];
    }
}