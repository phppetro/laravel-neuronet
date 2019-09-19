<?php
namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StorePublicationsRequest extends FormRequest
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
          'title' => 'max:191|required',
          'first_author_last_name' => 'max:191|required',
          'year' => 'max:191|required',
          'project_id' => 'required',
          'link' => 'max:191|required',
        ];
    }
}
