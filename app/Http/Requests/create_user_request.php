<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

class create_user_request extends FormRequest
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
            "name" => "required",
            "email" => "required|email|unique:users",
            "image" => "required|image",
            "password" => "required",
        ];
    }


    /** override failedValidation function to customize the validation api response
     * @param Validator $validator
     */
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'status' => __('messages.invalid_inputs'),
            'response' => $validator->errors()->all(),
        ])->setStatusCode(JsonResponse::HTTP_UNPROCESSABLE_ENTITY));
    }
}
