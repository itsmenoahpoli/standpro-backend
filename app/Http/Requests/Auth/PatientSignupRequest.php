<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class PatientSignupRequest extends FormRequest
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
            'account_data'                      => 'required',
            'account_data.name'                 => 'string|required',
            'account_data.email'                => 'email|required',
            'account_data.password'             => 'string|required',
            'patient_information'               => 'required',
            'patient_information.occupation'    => 'string|nullable',
            'patient_information.phone_no'      => 'string|required',
            'patient_information.telephone_no'  => 'string|nullable',
            'patient_information.birthdate'     => 'string|required',
            'patient_information.address_1'     => 'string|required',
            'patient_information.address_2'     => 'string|nullable',
        ];
    }
}
