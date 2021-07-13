<?php

namespace App\Http\Requests;

use App\Models\BusRating;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreBusRatingRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('bus_rating_create');
    }

    public function rules()
    {
        return [
            'bus_quality' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'punctuality' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'staff_behaviour' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
        ];
    }
}
