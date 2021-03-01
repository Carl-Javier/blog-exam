<?php

namespace App\Http\Requests\Backend\Articles;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class UpdateRequest
 * @package App\Http\Requests\Backend\News
 */
class UpdateRequest extends FormRequest
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
            'title'     => ['required'],
            'sub_title' => ['required'],
            'file'     => ['nullable', 'file', 'mimes:jpeg,jpg,gif,png,svg', 'max:2000'],
            'content'    => ['required'],
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [

        ];
    }
}

