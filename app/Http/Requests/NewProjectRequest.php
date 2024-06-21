<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewProjectRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'projectName' => 'required|max:255',
            'sourceLang' => 'required|max:255',
            'targetLang' => 'required|max:255',
            'ownerEmail' => 'required|email:rfc,dns|max:255',
            'files' => 'required',
        ];
    }
}
