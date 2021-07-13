<?php

namespace App\Http\Requests;

use App\Models\Passenger;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StorePassengerRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('passenger_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'mobile' => [
                'string',
                'required',
            ],
            'age' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
        ];
    }
}
