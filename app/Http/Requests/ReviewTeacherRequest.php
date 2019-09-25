<?php

namespace App\Http\Requests;

class ReviewTeacherRequest extends AbstractRequest
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
                    'id'          => 'required',
                    'name'        => 'required',
                    'description' => 'nullable|string',
                    'rating'      => 'required|numeric|max:6',
                ];
            default:
                return [
                    'name' => 'required',
                    'description' => 'nullable|string',
                    'rating' => 'required|numeric|max:6',
                    'teacher_id' => 'required',
                ];
        }
    }
}
