<?php
namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreProjectsRequest extends FormRequest
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
          'name' => 'min:3|max:191|required',
          'description' => 'required',
          'website' => 'min:3|max:191|required',
          'start_date' => 'required|date_format:'.config('app.date_format'),
          'end_date' => 'required|date_format:'.config('app.date_format'),
          'logo' => 'mimes:png,jpg,jpeg,gif|required',
        ];
    }
}
