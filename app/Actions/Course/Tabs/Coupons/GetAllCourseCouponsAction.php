<?php

namespace App\Actions\Course\Tabs\Coupons;

use App\Models\Coupon;
use Illuminate\Database\Eloquent\Collection;

class GetAllCourseCouponsAction
{
    /**
     * Execute the action.
     *
     * @param int $courseId
     * @return Collection
     */
    public function execute(int $courseId): Collection
    {
        $coupons = Coupon::where('course_id', $courseId)->get();
        return $coupons;
    }
}
