<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
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
        $baseRules['last_name'] = 'required|string|min:2|max:45';
        $baseRules['first_name'] = 'required|string|min:2|max:45';

        if($this->getMethod() === 'POST')
        {
            $baseRules['username'] = [
                'required', 'string', 'min:3', 'max:100', Rule::unique('users')->where(function ($query) {
                    return $query->whereNull('deleted_at');
                })
            ];
        }

        if($this->getMethod() === 'PUT' || $this->getMethod() === 'PATCH')
        {
            $baseRules['username'] = [
                'required', 'string', 'min:3', 'max:100', Rule::unique('users')->ignore($this->segment(2))->where(function ($query) {
                    return $query->whereNull('deleted_at');
                })
            ];
        }

        $baseRules['password'] = 'required|string|min:8|max:100|confirmed';
        $baseRules['role'] = 'required|integer|in:0,1';

        return $baseRules;
    }
}
