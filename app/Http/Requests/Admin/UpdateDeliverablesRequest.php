<?php
namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDeliverablesRequest extends FormRequest
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
          'deliverable_number' => 'max:191|required',
          'title' => 'min:3|max:191|required',
          'project_id' => 'required',
          'submission_date' => 'required|date_format:'.config('app.date_format'),
          'link' => 'min:3|max:191',
        ];
    }
}
