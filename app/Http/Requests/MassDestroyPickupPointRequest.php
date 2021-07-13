<?php

namespace App\Http\Requests;

use App\Models\PickupPoint;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyPickupPointRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('pickup_point_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:pickup_points,id',
        ];
    }
}
