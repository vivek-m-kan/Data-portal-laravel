<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class ClientRequest extends FormRequest
{

    protected array $allowedFields = [
        'name',
        'company_name',
        'street',
        "city",
        "state",
        "country",
        "postal_code",
        "contact_number",
        "is_verified",
        "status",
    ];

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->isAdmin;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        if ($this->method() === 'POST') {
            return [
                "name" => "required|max:100",
                "company_name" => 'required|max:100',
                "street" => 'required',
                "city" => 'required',
                "state" => 'required',
                "country" => 'required',
                "postal_code" => 'required',
                "contact_number" => 'required',
            ];
        } else {
            return [
                "name" => "required_with:company_name,street,city,state,country,postal_code,contact_number|max:100",
                "company_name" => 'required_with:name,street,city,state,country,postal_code,contact_number|max:100',
                "street" => 'required_with:name,company_name,city,state,country,postal_code,contact_number',
                "city" => 'required_with:name,company_name,street,state,country,postal_code,contact_number',
                "state" => 'required_with:name,company_name,street,city,country,postal_code,contact_number',
                "country" => 'required_with:name,company_name,street,city,state,postal_code,contact_number',
                "postal_code" => 'required_with:name,company_name,street,city,state,country,contact_number',
                "contact_number" => 'required_with:name,company_name,street,city,state,country,postal_code',
            ];
        }
    }

    /**
     * Handle a passed validation attempt.
     */
    protected function passedValidation(): void
    {
        $safe = $this->only($this->allowedFields);
        if ($this->method === "POST") {
            $safe['uuid'] = Str::uuid();
            $safe['created_by'] = $this->user()->uuid;
        }
        $this->replace($safe);
    }
}
