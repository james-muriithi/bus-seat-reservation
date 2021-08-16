<?php

namespace App\Http\Requests;

use App\Models\Reservation;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreReservationRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('reservation_create');
    }

    public function rules()
    {
        return [
            'ref' => [
                'string',
                'nullable',
            ],
            'passengers.*' => [
                'integer',
            ],
            'passengers' => [
                'required',
                'array',
            ],
            'pickup_point_id' => [
                'required',
                'integer',
            ],
            'trip_id' => [
                'required',
                'integer',
            ],
            'seats.*' => [
                'integer',
            ],
            'seats' => [
                'required',
                'array',
            ],
            'reservation_date' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
        ];
    }
}
