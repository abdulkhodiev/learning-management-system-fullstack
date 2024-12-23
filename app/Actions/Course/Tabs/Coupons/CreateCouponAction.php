<?php

namespace App\Actions\Course\Tabs\Coupons;

use App\Models\Coupon;

class CreateCouponAction
{
    /**
     * Creates a new coupon from the given data
     *
     * @param array $data
     *
     * @return void
     */
    public function execute(array $data )
    {
        Coupon::create($data);
    }
}
