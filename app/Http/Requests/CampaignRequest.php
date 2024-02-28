<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class CampaignRequest extends FormRequest
{
    protected array $allowedFields = ["name", "status"];

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
                "status" => "string:true, false"
            ];
        } else {
            return [
                "name" => "required_without:status|string|max:100",
                "status" => "string:true, false|required_with:name"
            ];
        }
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Please provide campaign name',
            'name.max' => 'Campaign name should not be more than :max chars.',
            "name.required_without_all" => "Please provide keys to update atleast name"
        ];
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
        $safe['status'] = $safe['status'] === 'true' ? true : false;
        $this->replace($safe);
    }
}
