<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
        // 新規データのみバリデーションさせる条件を組み込み、既存データには例外を設ける
        return [
            'name' => 'required|max:255',
            'price' => 'required|numeric|min:0|max:10000',
            'description' => 'required|max:120',
            'image' => $this->isMethod('post')
                ? 'required|image|mimes:png,jpeg|max:2048'
                : 'nullable|image|mimes:png,jpeg|max:2048',
            'season' => 'required|array',
            'season.*' => 'in:1,2,3,4',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '商品名を入力してください',
            'price.required' => '値段を入力してください',
            'price.numeric' => '数値で入力してください',
            'price.min' => '0~10000円以内で入力してください',
            'price.max' => '0~10000円以内で入力してください',
            'season.required' => '季節を選択してください',
            'description.required' => '商品説明を入力してください',
            'description.max' => '120文字以内で入力してください',
            'image.required' => '商品画像を登録してください',
            'image.mimes' => '「.png」または「.jpeg」形式でアップロードしてください',
        ];
    }
}
