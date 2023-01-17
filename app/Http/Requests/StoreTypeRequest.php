<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTypeRequest extends FormRequest
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
            'workflow'=>'required|max:15'
        ];
    }

    public function messages(){
        return [
            'workflow.required' => 'Il parametro è obbligatorio.',

            'workflow.max' => 'Il parametro non può superare i :max caratteri.',

        ];
    }
}
