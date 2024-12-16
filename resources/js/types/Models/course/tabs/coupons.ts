export interface Coupon {
  id: string
  status: string
  name: string
  coupon_code: string
  quantity: number
  uses_per_customer: number
  discount_amount: number
  start_time: string
  end_time: string
}
