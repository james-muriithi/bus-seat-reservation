<?php

namespace App\Http\Requests;

use App\Models\BusSeatClass;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateBusSeatClassRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('bus_seat_class_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'color' => [
                'string',
                'required',
            ],
            'status' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
        ];
    }
}
