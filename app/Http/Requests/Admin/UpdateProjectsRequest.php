<?php
namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProjectsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            
            'name' => 'required',
            'start_date' => 'nullable|date_format:'.config('app.date_format'),
            'end_date' => 'nullable|date_format:'.config('app.date_format'),
            'logo' => 'nullable|mimes:png,jpg,jpeg,gif',
        ];
    }
}
