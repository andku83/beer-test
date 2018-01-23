<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BeerRequest extends FormRequest
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
            'name' => ['required', 'max:255'],
            'text' => ['string'],
            'type_id' => ['required', 'integer', Rule::exists('beer_types', 'id')],
            'brand_id' => ['required', 'integer', Rule::exists('brands', 'id')],
            'status' => 'boolean',
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Name *',
            'text' => 'Text',
            'status' => 'Status',
            'type_id' => 'Type',
            'brand_id' => 'Brand',
        ];
    }
}
