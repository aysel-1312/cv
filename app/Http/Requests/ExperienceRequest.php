<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExperienceRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [

            'date'=>'required|max:255',
            'task_name'=>'required|max:255',
            'company_name'=>'required|max:255',
        ];
    }
    public function messages()
    {
        return [
            'date.required'=>'ÇalışmaTarihi girilmesi zorunludur',
            'date.max'=>'Çalışma Tarihi alanı için en fazla 255 karakter girebilirsiniz',
            'task_name.required'=>'Çalıştığınız pozisyon bilgisi girilmesi zorunludur',
            'task_name.max'=>'Çalıştığınız pozisyon bilgisi alanı için en fazla 255 karakter girilmesi zorunludur',
            'company_name.required'=>'Çalıştığınız firma bilgisigirilmesi zorunludur',
            'company_name.max'=>'Çalıştığınız firma bilgisialanı için en fazla 255 karakter girebilirsniz',

        ];
    }
}
