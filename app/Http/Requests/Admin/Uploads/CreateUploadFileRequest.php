<?php

namespace App\Http\Requests\Admin\Uploads;

use Illuminate\Foundation\Http\FormRequest;

class CreateUploadFileRequest extends FormRequest
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
            'upload_folder_id'  => 'int|required',
            'name'              => 'string|required|unique:upload_files',
            'description'       => 'string|required',
            'files'             => 'required|array'
        ];
    }
}
