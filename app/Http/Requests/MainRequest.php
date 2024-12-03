<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;


class MainRequest extends FormRequest{

    public function authorize(){

        return true;
    }

    public function failedValidation(Validator $validator)
    {
        $er = collect($validator->errors()->keys())->map(function ($k) use ($validator) {
            //formatting error
            $e = collect($validator->errors()->get($k))->map(function ($em) {
                return count(explode("+", $em)) == 1 ? ['code' => explode("+", $em)[0]] : ['code' => explode("+", $em)[0], 'paramter' => explode("+", $em)[1]];
            });
            //formatting field name
            $isArrayField = collect(explode('.', $k))->filter(fn ($v) => is_numeric($v))->count() > 0;
            if ($isArrayField) {
                $filedName = collect(explode('.', $k))->filter(fn ($v) => !is_numeric($v))->join('.');
                $index = collect(explode('.', $k))->filter(fn ($v) => is_numeric($v))->first();
            } else {
                $filedName = $k;
                $index = null;
            }
            if ($index == null) {
                return  ['field' => $filedName, 'errors' => $e];
            } else {
                return  ['field' => $filedName, 'index' => $index, 'errors' => $e];
            }
        });

        throw new HttpResponseException( response()->json(['success' => false,'status' =>422,'data' =>[],
        'message' => $er[0]['errors'][0]['code']],422));

    }

}

