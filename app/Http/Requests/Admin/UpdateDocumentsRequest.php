<?php
namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDocumentsRequest extends FormRequest
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
          'source' => 'max:191|required',
          'publication_date' => 'required|date_format:'.config('app.date_format'),
          'file' => 'required|mimes:pdf,jpeg,png,gif,doc,docx',
        ];
    }
}
