<?php

namespace App\Http\Controllers\CourseControllers;

use App\Actions\Course\Tabs\Coupons\GetAllCourseCouponsAction;
use App\Actions\Course\Tabs\Coupons\UpdateCouponAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Course\Tabs\Coupons\CreateCouponRequest;
use App\Http\Requests\Course\Tabs\Coupons\UpdateCouponRequest;
use App\Models\Coupon;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;


class CourseCouponController extends Controller
{
/**
 * Retrieve all coupons for a given course.
 *
 * @param GetAllCourseCouponsAction $action The action to execute for retrieving course coupons.
 * @param int $courseId The ID of the course whose coupons are to be retrieved.
 * @return \Inertia\Response
 */

    public function index(GetAllCourseCouponsAction $action, int $courseId): Response
    {
        $coupons = $action->execute($courseId);
        return Inertia::render('Courses/Tabs/Coupons/Index', [
            'coupons'=> $coupons,
        ] );
    }


    /**
     * Display the form to create a new coupon for a given course.
     *
     * @return \Inertia\Response
     */
    public function create(): Response
    {
        return Inertia::render('Courses/Tabs/Coupons/CreateEdit');
    }

    /**
     * Store a newly created coupon in storage.
     *
     * @param CreateCouponRequest $request The request containing the data to create the coupon.
     * @param CreateCouponRequest $action The action to execute for creating the coupon.
     * @return \Illuminate\Http\RedirectResponse A redirect response to the coupons index page.
     */

    public function store(CreateCouponRequest $request, CreateCouponRequest $action): RedirectResponse
    {
        $action->execute($request->validated());

        return redirect()->route('courses.tabs.coupons.index', $request->course_id);
    }

    /**
     * Display the form to edit a coupon for a given course.
     *
     * @param Coupon $coupon The coupon to edit.
     * @return \Inertia\Response
     */
    public function edit(Coupon $coupon): Response
    {
        return Inertia::render('Courses/Tabs/Coupons/CreateEdit', [
            'coupon' => $coupon
        ]);
    }

    /**
     * Update the specified coupon in storage.
     *
     * @param UpdateCouponRequest $request The request containing the data to update the coupon.
     * @param Coupon $coupon The coupon to update.
     * @param UpdateCouponAction $action The action to execute for updating the coupon.
     * @return \Illuminate\Http\RedirectResponse A redirect response to the coupons index page.
     */

    public function update(UpdateCouponRequest $request, Coupon $coupon, UpdateCouponAction $action): RedirectResponse
    {
        $action->execute($coupon, $request->validated());

        return redirect()->route('courses.tabs.coupons.index', $request->course_id);
    }

    /**
     * Remove the specified coupon from storage.
     *
     * @param Coupon $coupon The coupon to delete.
     * @return \Illuminate\Http\RedirectResponse A redirect response to the coupons index page.
     */
    public function destroy(Coupon $coupon): RedirectResponse
    {
        $coupon->delete();

        return redirect()->route('courses.tabs.coupons.index', $coupon->course_id);
    }




}
