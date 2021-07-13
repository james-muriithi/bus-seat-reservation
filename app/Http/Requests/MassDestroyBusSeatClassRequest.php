<?php

namespace App\Http\Requests;

use App\Models\BusSeatClass;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyBusSeatClassRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('bus_seat_class_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:bus_seat_classes,id',
        ];
    }
}
