<?php

namespace App\Http\Requests;

use App\Models\Route;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreRouteRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('route_create');
    }

    public function rules()
    {
        return [
            'bus_id' => [
                'required',
                'integer',
                'exists:buses,id'
            ],
            'board_point' => [
                'string',
                'required',
            ],
            'board_time' => [
                'required',
                'date_format:H:i',
            ],
            'drop_point' => [
                'string',
                'required',
            ],
            'drop_time' => [
                'required',
                'date_format:H:i',
            ],
            'fare' => [
                // 'integer',
                'required_if:seat_classes.*,null',
            ],
            'seat_classes' => [
                'array',
                'required_if:fare,null'
            ],
        ];
    }
}
