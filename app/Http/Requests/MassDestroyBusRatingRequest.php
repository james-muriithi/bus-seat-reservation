<?php

namespace App\Http\Requests;

use App\Models\BusRating;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyBusRatingRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('bus_rating_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:bus_ratings,id',
        ];
    }
}
