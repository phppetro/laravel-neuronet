<?php
namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCalendarsRequest extends FormRequest
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
            
            'title' => 'required',
            'location' => 'required',
            'start_date' => 'required|date_format:'.config('app.date_format'),
            'end_date' => 'required|date_format:'.config('app.date_format'),
            'color_id' => 'required',
            'projects.*' => 'exists:projects,id',
        ];
    }
}
