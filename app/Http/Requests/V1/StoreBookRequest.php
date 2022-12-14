<?php

namespace App\Http\Requests\V1;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StoreBookRequest extends FormRequest
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
            'isbn' => ['required', 'regex:/[0-9][0-9][0-9]-[0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9]/'],
            'title' => ['required'],
            'author' => ['required'],
            'category' => ['required'],
            'price' => ['required']
        ];
    }

    /**
     * Transform json naming convention to DB convention
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $this->merge([
            
        ]);
    }
}
