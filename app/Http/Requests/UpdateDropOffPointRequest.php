<?php

namespace App\Http\Requests;

use App\Models\DropOffPoint;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateDropOffPointRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('drop_off_point_edit');
    }

    public function rules()
    {
        return [
            'drop_off_point' => [
                'string',
                'required',
            ],
            'drop_time' => [
                'required',
                'date_format:H:i',
            ],
            'landmark' => [
                'string',
                'nullable',
            ],
            'address' => [
                'string',
                'nullable',
            ],
            'route_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
