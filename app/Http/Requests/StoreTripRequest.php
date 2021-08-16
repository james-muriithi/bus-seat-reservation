<?php

namespace App\Http\Requests;

use App\Models\Trip;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreTripRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('trip_create');
    }

    public function rules()
    {
        return [
            'trip_id' => [
                'string',
                'nullable',
            ],
            'travel_date' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'status' => [
                'nullable',
            ],
        ];
    }
}
