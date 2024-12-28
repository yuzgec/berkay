<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PageRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title'                 => 'required|min:6|max:99|unique:page,title,'.$this->id,
            'category'              => 'required',
            'image'                 => 'image|mimes:jpg,jpeg,png,gif',
            'images.*'              => 'image|mimes:jpg,jpeg,png,gif',
        ];
    }

    public function messages()
    {
        return [
            'title.required'            => 'Sayfa başlığını giriniz',
            'title.max'                 => 'Sayfa başlığı en fazla 99 karakter olabilir',
            'title.min'                 => 'Sayfa başlığı en fazla 6 karakter olabilir',
            'title.unique'              => 'Sayfa başlığı daha önce eklenmiş',
            'category.required'         => 'Sayfa Kategori seçimi zorunludur.',
            'image.mimes'               => 'Resim formatı jpg,jpeg,png,gif olmalıdır',
            'image.image'               => 'Resim formatı uygun değildir.',
            'images.*.mimes'           => 'Resim formatı jpg,jpeg,png,gif olmalıdır',
            'images.*.image'           => 'Resim formatı uygun değildir.',

        ];
    }
}
