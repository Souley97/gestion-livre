<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreLivreRequest extends FormRequest
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
                'isbn' => ["required", "string", "unique:livres,isbn"],
                "categorie_id" => ["required", "string", "exists:categories,id"],
                'titre' => ['required', 'string', 'max:255'],
                'auteur' => ['required', 'string', 'max:255'],
                'date_publication' => ['required', 'date', 'before:now'],
                "quantite" => ['required', "integer", "min:1"],
                'image' => ['required', 'max:2048'],
            ];
        }
        public function failedValidation(Validator $validator)
        {
            throw new HttpResponseException(response()->json(
                [
                    'success' => false,
                    'errors' => $validator->errors()
                ],
                422
            ));
        }
    }
