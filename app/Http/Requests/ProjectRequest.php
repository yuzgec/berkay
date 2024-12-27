<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProjectRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => [
                'required',
                'min:6',
                'max:99',
                Rule::unique('project', 'title')->ignore($this->id)
            ],
            'category' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Proje başlığını giriniz',
            'title.max' => 'Proje başlığı en fazla 99 karakter olabilir',
            'title.min' => 'Proje başlığı en az 6 karakter olabilir',
            'title.unique' => 'Proje başlığı daha önce eklenmiş',
            'category.required' => 'Proje Kategori seçimi zorunludur.'
        ];
    }
}
