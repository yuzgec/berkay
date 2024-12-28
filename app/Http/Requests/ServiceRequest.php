<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServiceRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title'                 => 'required|min:3|max:99|unique:service,title,'.$this->id,
            'category'              => 'required',
            'image'                 => 'image|mimes:jpg,jpeg,png,gif',
            'images.*'              => 'image|mimes:jpg,jpeg,png,gif',
        ];
    }

    public function messages()
    {
        return [
            'title.required'            => 'Hizmet başlığını giriniz',
            'title.max'                 => 'Hizmet başlığı en fazla 99 karakter olabilir',
            'title.min'                 => 'Hizmet başlığı en az 3 karakter olabilir',
            'title.unique'              => 'Hizmet başlığı daha önce eklenmiş',
            'category.required'         => 'Hizmet Kategori seçimi zorunludur.',
            'image.mimes'               => 'Resim formatı jpg,jpeg,png,gif olmalıdır',
            'image.image'               => 'Resim formatı uygun değildir.',
            'images.*.mimes'           => 'Resim formatı jpg,jpeg,png,gif olmalıdır',
            'images.*.image'           => 'Resim formatı uygun değildir.',

        ];
    }
}
