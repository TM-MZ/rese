<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShopRequest extends FormRequest
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
            'name' => 'required|max:100',
            'area' => 'required|integer',
            'genre' => 'required|integer',
            'picture'=>'file|image'
        ];
    }
    public function messages()
    {
        return [
            'name.required' => '店舗名を入力してください',
            'name.max'=>'100文字以内で入力してください',
            'area.integer' => '整数の形式で入力してください',
            'genre.integer' => '整数の形式で入力してください',
            'picture.image'=>'イメージファイルを選択してください'
        ];
    }
}
