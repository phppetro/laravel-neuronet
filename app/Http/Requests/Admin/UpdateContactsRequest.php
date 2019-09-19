<?php
namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateContactsRequest extends FormRequest
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
          'first_name' => 'max:191|required',
          'last_name' => 'max:191|required',
          'email' => 'max:191|required|email',
          'position' => 'max:191',
          'institution' => 'max:191|required',
          'category_id' => 'required',
          'projects_involved' => 'max:191',
        ];
    }
}
