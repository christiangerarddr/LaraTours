<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookingRequest extends FormRequest
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
            'passengers.*'  => ['required'],
            'passengers.*'  => ['required'],
            'tour_date'     => ['required', 'string'],
            'status'        => ['boolean'],
            'passengers.*.pivot.special_request' => ['required', 'string'],
            'passengers.*.given_name' => ['required', 'string'],
            'passengers.*.birth_date' => ['required', 'date'],
            'passengers.*.passport' => ['required', 'string'],
            'passengers.*.surname' => ['required', 'string'],
            'passengers.*.mobile' => ['required', 'string'],
            'passengers.*.email' => ['required', 'email'],
            'removedPassenger.*.id' => ['required'],
            'removedPassenger' => ['array'],
        ];
    }
}
