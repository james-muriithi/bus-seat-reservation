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
            'route_id' => [
                'required',
                'integer',
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
