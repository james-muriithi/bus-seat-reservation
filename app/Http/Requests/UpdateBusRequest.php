<?php

namespace App\Http\Requests;

use App\Models\Bus;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateBusRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('bus_edit');
    }

    public function rules()
    {
        return [
            'bus_name' => [
                'string',
                'required',
            ],
            'bus_reg_no' => [
                'string',
                'required',
            ],
            'bus_type_id' => [
                'required',
                'integer',
            ],
            'max_seats' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'amenities.*' => [
                'integer',
            ],
            'amenities' => [
                'array',
            ],
            'seat_classes' => [
                'required',
                'array',
            ],
        ];
    }
}
