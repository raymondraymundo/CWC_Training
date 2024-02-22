<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ArticleRequest extends FormRequest
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
        $baseRules = [];

        $baseRules['title'] = 'required|string|min:2|max:255';
        $baseRules['article_category_id'] = 'required|integer|exists:article_categories,id';

        if($this->getMethod() === 'POST')
        {
            $baseRules['slug'] = [
                'required', 'string', 'min:2', 'max:255', Rule::unique('articles')->where(function ($query) {
                    return $query->whereNull('deleted_at');
                })
            ];

            $baseRules['image'] = 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048';
        }

        if($this->getMethod() === 'PUT' || $this->getMethod() === 'PATCH')
        {
            $baseRules['slug'] = [
                'required', 'string', 'min:2', 'max:255', Rule::unique('articles')->ignore($this->segment(2))->where(function ($query) {
                    return $query->whereNull('deleted_at');
                })
            ];

            if($this->hasFile('image'))
                $baseRules['image'] = 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048';
        }

        $baseRules['contents'] = 'required|string';

        return $baseRules;
    }
}
