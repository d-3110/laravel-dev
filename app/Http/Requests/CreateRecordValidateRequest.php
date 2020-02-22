<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateRecordValidateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'user_id'    => 'required',
            'start_time' => ['required','date_format:"H:i"'],
            'end_time'   => ['required','date_format:"H:i"'],
            'break_time' => ['required','date_format:"H:i"'],
            'date' => [
                        'required',
                        'date_format:"Y-m-d"',
                        Rule::unique('attendance_records')->ignore($this->input('id'))->where(function($query) {
                                // 入力されたfirstの値と同じ値を持つレコードでのみ検証する
                                $query->where('user_id', $this->input('user_id'));
                            }),
                        ],
        ];
    }
}
