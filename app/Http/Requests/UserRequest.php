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
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'password' =>  ($this -> isMethod("put") ? ['nullable','confirmed', 'string', 'min:8'] : ['required', 'string', 'min:8', 'confirmed']),
            'address' => ['required','max:191'],
            'email' => array('required',
            'max:191','string','email',
            Rule::unique('users')->ignore($this->route('endUser')),
            ),
            'username' => array('required',
            'max:191','string',
            Rule::unique('users')->ignore($this->route('endUser')),
            ),
            'phone' => array('required',
            'digits_between:10,14',
            Rule::unique('users')->ignore($this->route('endUser')),
            ),
            'avatar'  => ($this -> isMethod("put") ? "nullable" : "required") . "|image"
        ];
    }
}
