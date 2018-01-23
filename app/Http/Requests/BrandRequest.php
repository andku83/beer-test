<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BrandRequest extends FormRequest
{
    protected $method = 'PUT';

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
            'name' => ['required', 'max:255', Rule::unique('brands')->ignore($this->brand)],
            'status' => 'boolean',
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Name *',
            'status' => 'Status',
        ];
    }
}
