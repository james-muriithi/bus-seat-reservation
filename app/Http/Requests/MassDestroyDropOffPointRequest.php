<?php

namespace App\Http\Requests;

use App\Models\DropOffPoint;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyDropOffPointRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('drop_off_point_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:drop_off_points,id',
        ];
    }
}
