<?php

namespace App\Http\Requests;

use App\Models\Reservation;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateReservationRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('reservation_edit');
    }

    public function rules()
    {
        return [
            'passenger_id' => [
                'required',
                'integer',
            ],
            'pickup_point_id' => [
                'required',
                'integer',
            ],
            'reservation_date' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'seats.*' => [
                'integer',
            ],
            'seats' => [
                'required',
                'array',
            ],
        ];
    }
}
