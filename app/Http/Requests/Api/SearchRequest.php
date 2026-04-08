<?php

namespace App\Http\Requests\Api;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class SearchRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'query' => 'required|string|min:2|max:100',
            'type' => 'nullable|string|in:all,products,categorys',
            'page' => 'nullable|integer|min:1',
            'limit' => 'nullable|integer|min:1|max:50',
            'sortBy' => 'nullable|string|in:relevance,price_asc,price_desc,newest,popularity',
            'sortOrder' => 'nullable|string|in:asc,desc',
            'filters' => 'nullable|array',
            'filters.*.field' => 'required_with:filters|string|in:price,brand,rating',
            'filters.*.operator' => 'required_with:filters|string|in:equals,not_equals,greater_than,less_than,greater_or_equal,less_or_equal',
            'filters.*.value' => 'required_with:filters|string',
            'filters.*.value.*' => 'required_with:filters|string',
            'filters.*.value.*.field' => 'required_with:filters|string|in:price,brand,rating',
            'filters.*.value.*.operator' => 'required_with:filters|string|in:equals,not_equals,greater_than,less_than,greater_or_equal,less_or_equal',
            'filters.*.value.*.value' => 'required_with:filters|string',
        ];
    }
}
