<?php

namespace App\Http\Requests;

use App\Models\BusType;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreBusTypeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('bus_type_create');
    }

    public function rules()
    {
        return [
            'bus_type' => [
                'string',
                'required',
            ],
        ];
    }
}
