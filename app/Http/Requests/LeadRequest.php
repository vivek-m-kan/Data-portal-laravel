<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class LeadRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "first_name" => "required",
            "last_name" => "required",
            "email" => "required|email",
            "phone" => "required",
            "country" => "required",
            "state" => "required",
            "city" => "required",
            "postal_code" => "required",
            "campaign_id" => "required"
        ];
    }

    protected function passedValidation(): void
    {
        $safe = [];
        $safe['uuid'] = Str::uuid();
        $safe['details'] = $this->except('campaign_id');
        $safe['campaigns_id'] = $this->campaign_id;
        $this->replace($safe);
    }
}
