<?php

namespace App\Http\Requests;

use App\Models\SystemSetting;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateSystemSettingRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('system_setting_edit');
    }

    public function rules()
    {
        return [
            'default_currency_id' => [
                'required',
                'integer',
            ],
            'company_name' => [
                'string',
                'required',
            ],
            'smtp_username' => [
                'string',
                'nullable',
            ],
            'smtp_host' => [
                'string',
                'nullable',
            ],
            'smtp_password' => [
                'string',
                'nullable',
            ],
        ];
    }
}
