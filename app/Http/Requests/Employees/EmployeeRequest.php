<?php

namespace App\Http\Requests\Employees;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

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

    protected function failedValidation(Validator $validator) {
        throw new HttpResponseException(response()->json([
            'status' => 'false',
            'message' => $validator->errors()->first()], 422));
        // throw new HttpResponseException(response()->json($validator->errors()->first(), 422));
    }
}
