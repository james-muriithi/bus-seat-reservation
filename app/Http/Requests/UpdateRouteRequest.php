<?php

namespace App\Http\Requests;

use App\Models\Route;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateRouteRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('route_edit');
    }

    public function rules()
    {
        return [
            'bus_id' => [
                'required',
                'integer',
            ],
            'board_point' => [
                'string',
                'required',
            ],
            'board_time' => [
                'required',
                'date_format:' . config('panel.time_format'),
            ],
            'drop_point' => [
                'string',
                'required',
            ],
            'drop_time' => [
                'required',
                'date_format:' . config('panel.time_format'),
            ],
            'fare' => [
                'required',
            ],
        ];
    }
}
