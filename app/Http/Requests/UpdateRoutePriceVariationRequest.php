<?php

namespace App\Http\Requests;

use App\Models\RoutePriceVariation;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateRoutePriceVariationRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('route_price_variation_edit');
    }

    public function rules()
    {
        return [
            'pickup_point_id' => [
                'required',
                'integer',
            ],
            'drop_point_id' => [
                'required',
                'integer',
            ],
            'seat_classes.*' => [
                'integer',
            ],
            'seat_classes' => [
                'array',
            ],
        ];
    }
}
