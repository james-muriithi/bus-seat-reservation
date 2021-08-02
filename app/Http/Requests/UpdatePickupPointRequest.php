<?php

namespace App\Http\Requests;

use App\Models\PickupPoint;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdatePickupPointRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('pickup_point_edit');
    }

    public function rules()
    {
        return [
            'pickup_point' => [
                'string',
                'required',
            ],
            'pickup_time' => [
                'required',
                'date_format:H:i',
            ],
            'route_id' => [
                'required',
                'integer',
            ],
            'landmark' => [
                'string',
                'nullable',
            ],
            'address' => [
                'string',
                'nullable',
            ],
        ];
    }
}
