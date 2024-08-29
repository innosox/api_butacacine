<?php


namespace App\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBillboardRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     */
    public function rules(): array
    {
        return [
            'date' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'movie_id' => 'required',
            'room_id' => 'required',
        ];
    }

}
