<?php

namespace App\Actions\Course\Tabs\Coupons;

use App\Models\Coupon;

class DestroyCouponAction
{
    /**
     * Execute the action.
     *
     * @param Coupon $coupon
     *
     * @return void
     */
    public function execute(Coupon $coupon)
    {
        $coupon->delete();
    }
}

