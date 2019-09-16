<?php
namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePartnersRequest extends FormRequest
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
            
            'name' => 'required|unique:partners,name,'.$this->route('partner'),
            'projects' => 'required',
            'projects.*' => 'exists:projects,id',
            'type_of_institution_id' => 'required',
            'country_id' => 'required',
        ];
    }
}
