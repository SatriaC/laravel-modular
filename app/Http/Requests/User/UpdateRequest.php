<?php

namespace App\Http\Requests\User;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Foundation\Http\FormRequest;

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
            'nip'=>'prohibited',
            'nik'=>'required',
            'name'=>'required',
            'gender'=>'required',
            'birthdate'=>'required',
            'birthplace'=>'required',
            'address'=>'required',
            'phone'=>'required',
            'email'=>'required',
            'organization'=>'prohibited',
            'division'=>'prohibited',
            'department'=>'prohibited',
            'position'=>'prohibited',
            'manager_id'=>'prohibited',
            'status'=>'prohibited',
            'start_at'=>'prohibited',
            'end_at'=>'prohibited',

        ];
    }

    public function messages()
    {
        return [
            'prohibited' => ':attribute cannot be updated',
        ];
    }

    protected function failedValidation(Validator $validator) {
        throw new HttpResponseException(response()->json([
            'status' => 'false',
            'message' => $validator->errors()->first()], 422));
        // throw new HttpResponseException(response()->json($validator->errors()->first(), 422));
    }
}
