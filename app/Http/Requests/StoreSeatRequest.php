<?php

namespace App\Http\Requests;

use App\Models\Seat;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreSeatRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('seat_create');
    }

    public function rules()
    {
        return [
            'bus_id' => [
                'required',
                'integer',
            ],
            'row' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'column' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'name' => [
                'string',
                'nullable',
            ],
            'details' => [
                'string',
                'nullable',
            ],
        ];
    }
}
