<?php

namespace App\Actions\Course\Tabs\Coupons;

use App\Models\Coupon;

class UpdateCouponAction
{
    /**
     * Update the given coupon with the provided data.
     *
     * @param  Coupon  $coupon The coupon instance to be updated.
     * @param  array  $data The data to update the coupon with.
     * @return Coupon The updated coupon instance.
     */
    public function execute(Coupon $coupon, array $data): Coupon
    {
        $coupon->update($data);

        return $coupon;
    }
}
