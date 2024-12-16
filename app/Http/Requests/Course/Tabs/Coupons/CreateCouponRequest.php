<?php

namespace App\Http\Requests\Course\Tabs\Coupons;


use Illuminate\Foundation\Http\FormRequest;

class CreateCouponRequest extends FormRequest
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
            'course_id' => ['required', 'exists:courses,id'],
            'status' => ['required', 'string', 'max:255'],
            'name' => ['required', 'string', 'max:255'],
            'coupon_code ' => ['required', 'string', 'max:255'],
            'quantity ' => ['required', 'integer', 'min:1'],
            'uses_per_customer ' => ['required', 'integer', 'min:1'],
            'discount_amount ' => ['required', 'numeric', 'min:1'],
            'start_time ' => ['required', 'date', 'before:end_time'],
            'end_time ' => ['required', 'date', 'after:start_time'],
        ];


    }
}
