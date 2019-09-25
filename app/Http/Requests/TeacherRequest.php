<?php

namespace App\Http\Requests;


class TeacherRequest extends AbstractRequest
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
        switch ($this->method()) {
            case 'PATCH':
            case 'PUT':
                return [

                ];
            default:
                return [
                    'name' => 'required|string',
                    'description' => 'nullable|string',
                    'birthday' => 'required',
                    'gender' => 'required|boolean',
                    'address' => 'required|string',
                    'phone' => 'nullable|numeric',
                    'specialize' => 'required',
                    'image' => 'nullable',
                    'identity_card' => 'nullable',
                    'email' => 'nullable|email',
                ];
        }
    }
}
