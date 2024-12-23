<?php

namespace App\Actions\Course\Tabs\Coupons;

use App\Models\Coupon;
use Illuminate\Support\Facades\DB;

class GetCouponStatistics
{
    public function execute(int $courseId): array
    {
        // Sum of coupon quantities
        $couponCount = Coupon::where('course_id', $courseId)->sum('quantity');

        // Sum of (discount_amount * quantity)
        $couponAmount = Coupon::where('course_id', $courseId)
            ->select(DB::raw('SUM(discount_amount * quantity) as total'))
            ->value('total');

        // Calculate average discount amount
        $averageAmount = $couponCount > 0 ? $couponAmount / $couponCount : 0;

        return [
            'couponCount' => $couponCount,
            'couponAmount' => $couponAmount,
            'averageAmount' => $averageAmount,
        ];
    }
}
