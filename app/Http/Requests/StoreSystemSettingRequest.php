<?php

namespace App\Http\Requests;

use App\Models\SystemSetting;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreSystemSettingRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('system_setting_create');
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
            'company_logo' => [
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
