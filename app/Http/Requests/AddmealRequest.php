<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddmealRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'photo' => 'required_without:id|mimes:jpg,jpeg,png,',
            'price' => 'numeric',
            'description' => 'required,text,string',
            'meal' => 'required|array|min:1',
            'meal.*.name' => 'required',
            'meal.*.abbr' => 'required',
            //'category.*.active' => 'required',
            'meal.*.active' => 'sometimes|boolean',
        ];
    }

    public function messages()
    {
        return [
            'required' => 'هذا الحقل مطلوب',
            'mimes:jpg,jpeg,png,' => 'الإمتداد غير صحيح',
            'mimes' => 'هذه ليست صورة',
            'in' => 'القيم المدخلة غير صحيحة ',
            'name.string' => 'اسم اللغة لابد ان يكون احرف',
            'abbr.max' => 'هذا الحقل لابد الا يزيد عن 10 احرف ',
            'abbr.string' => 'هذا الحقل لابد ان يكون احرف ',
            'string' => 'هذا الحقل لابد ان يكون احرف ',
            'number' =>'هذا الحقل لابد ان يكون رقم .',
            'numeric' =>'هذا الحقل يجب ان يكون عدد .',
            'name.max' => 'اسم اللغة لابد الا يزيد عن 100 احرف ',
        ];
    }
}
