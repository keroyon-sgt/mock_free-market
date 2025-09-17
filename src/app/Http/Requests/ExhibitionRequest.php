<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExhibitionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // return false;
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
            'title' => ['required'],
            'price' => ['required', 'integer', 'min:1'],
            'brand',
            'description' => ['required', 'string', 'max:255'],
            'image' => ['required'],
            'category' => ['required'],
            'condition' => ['required'],
        ];
    }
    public function messages()
    {
        return [
            'title.required' => '商品名を入力してください',
            'price.required' => '価格を入力してください',
            'description.required' => '説明を入力してください',
            'image.required' => '画像ファイルを選択してください',
            'category.required' => 'カテゴリーを選択してください',
            'condition.required' => '状態を選択してください',
        ];
    }
}
