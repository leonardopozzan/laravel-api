<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class UpdateProjectRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => ['required', 'max:45',Rule::unique('projects')->ignore($this->project)],
            'type_id' => 'exists:types,id|nullable',
            'description' => 'nullable',
            'framework' => 'nullable',
            'team' => 'nullable',
            'git_link' => 'nullable',
            'diff_lvl' => 'nullable|min:0|max:10',
            'image' => 'nullable|max:5000',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'il nome è obbligatorio',
            'type_id.exists' => 'il tipo non esiste',
            'name.unique' => 'il nome è già presente',
            'name.max' => 'il nome deve avere meno di :max caratteri',
            'diff_lvl.min' => 'il livello di difficoltà non può essere inferiore a :min',
            'diff_lvl.max' => 'il livello di difficoltà non può essere superiore a :max',
            'image.max' => 'l\'immagine è troppo grande',
        ];
    }
}
