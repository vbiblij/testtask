<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TemplateRequest extends FormRequest
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
            'name' => 'required|min:5',
            'content' => 'required|min:5',
        ];
    }
	
	public function messages()
	{
		return [
			'name.required' => 'Необходимо указать заголовок',
			'content.required'  => 'Необходимо написать контент',
			'name.min' => 'Имя должно быть минимум 5 символов',
			'content.min'  => 'Письмо должно быть минимум 5 символов',
		];
	}
}
