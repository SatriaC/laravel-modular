<?php

namespace Attendance\Requests;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Foundation\Http\FormRequest;

class CheckinRequest extends FormRequest
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
            'image'=>'required',
            'location'=>'required',
            'latitude'=>'required',
            'longitude'=>'required',
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
