<?php

namespace App\Http\Requests\Employees;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequest extends FormRequest
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
            'nip'=>'required',
            'nik'=>'required',
            'name'=>'required',
            'gender'=>'required',
            'birthdate'=>'required',
            'birthplace'=>'required',
            'address'=>'required',
            'phone'=>'required',
            'email'=>'required',
            'organization'=>'required',
            'division'=>'required',
            'department'=>'required',
            'position'=>'required',
            'start_at'=>'required',
        ];
    }
}
