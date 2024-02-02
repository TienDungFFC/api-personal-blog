<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

abstract class BaseRequest extends FormRequest
{
    protected function failedValidation(Validator $validator)
    {
        $transformed = [
            'message'   => 'Invalid parameter',
            'data'      => [],
        ];
        $errors = $validator->errors();
        foreach ($errors->keys() as $key) {
            $transformed['data'][$key] = $errors->get($key, [])[0];
        }
        throw new HttpResponseException($this->response($transformed));
    }

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [];
    }

    public function response(array $errors)
    {
        return new JsonResponse($errors, 422);
    }
}