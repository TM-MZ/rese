<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReserveRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            //
            'date' => 'required|date|after:today',
            'time' => 'required|date_format:G:i',
            'number' => 'required|integer',
        ];
    }
    public function messages(){
        return [
            'date.required'=>'※予約日を入力してください',
            'date.date'=>'※予約日を正しい形式で入力してください',
            'date.after'=>'※予約日は明日以降の日付で入力してください',
        ];
    }
}
