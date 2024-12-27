<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FeaturesRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title'                 => 'required|min:3|max:99|unique:features,title,'.$this->id,
            'category'              => 'required',
        ];
    }

    public function messages()
    {
        return [
            'title.required'            => 'Özellik başlığını giriniz',
            'title.max'                 => 'Özellik başlığı en fazla 99 karakter olabilir',
            'title.min'                 => 'Özellik başlığı en az 3 karakter olabilir',
            'title.unique'              => 'Özellik başlığı daha önce eklenmiş',
            'category.required'         => 'Özellik Kategori seçimi zorunludur.'
        ];
    }
}
