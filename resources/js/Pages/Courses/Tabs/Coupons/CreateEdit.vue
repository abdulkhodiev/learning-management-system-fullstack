<script lang="ts" setup>
import { Button } from "@/components/ui/button"
import { ArrowLeft } from "lucide-vue-next"
import { router, useForm, usePage } from "@inertiajs/vue3"
import { Label } from "@/components/ui/label"
import { Input } from "@/components/ui/input"
import { toast } from "vue-sonner"
import { Coupon } from "@/types/Models/course/tabs/coupons"
import {
  Select,
  SelectContent,
  SelectGroup,
  SelectItem,
  SelectTrigger,
  SelectValue,
} from "@/components/ui/select"
import Layout from "../_components/Layout.vue"

defineOptions({
  layout: Layout,
})

const course = usePage().url.split("/")[2]

const props = defineProps<{
  coupon?: Coupon
}>()

const couponForm = useForm({
  name: props.coupon?.name || "",
  status: props.coupon?.status || "",
  coupon_code: props.coupon?.coupon_code || "",
  discount_amount: props.coupon?.discount_amount || "",
  quantity: props.coupon?.quantity || "",
  uses_per_customer: props.coupon?.uses_per_customer || "",
  start_time: props.coupon?.start_time || "",
  end_time: props.coupon?.end_time || "",
  course_id: course as string,
})

/**
 * Handles coupon form submission. If a coupon is provided in the
 * component props, the form will send a PUT request to update the
 * coupon. Otherwise, a POST request will be sent to create a new
 * coupon.
 *
 * In either case, if the request is successful, a success toast will
 * be displayed and the user will be redirected to the course's coupon
 * index page. If there are errors, an error toast will be displayed
 * with the errors.
 */
const handleSubmit = () => {
  if (props.coupon) {
    couponForm.put(`/courses/${course}/coupons/${props.coupon.id}`, {
      onSuccess: () => {
        toast.success("Coupon updated successfully!")
        router.get(`/courses/${course}/coupons`)
      },
      onError: errors => {
        toast.error("Errors while updating coupon:", errors)
      },
    })
  } else {
    couponForm.post(`/courses/${course}/coupons`, {
      onSuccess: () => {
        toast.success("Coupon added successfully!")
        router.get(`/courses/${course}/coupons`)
      },
      onError: errors => {
        console.log(errors)
        toast.error("Errors while adding coupon:", errors)
      },
    })
  }
}
</script>

<template>
  <div class="space-y-4">
    <div class="flex items-center justify-between">
      <h2>{{ props.coupon ? "Edit" : "Add" }} Coupon</h2>
      <Button @click="router.get(`/courses/${course}/coupons`)"
        ><ArrowLeft /> Back</Button
      >
    </div>
    <div class="rounded-xl bg-white p-4">
      <form class="space-y-4" @submit.prevent="handleSubmit">
        <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
          <div class="space-y-2 rounded-lg">
            <Label for="title">Title</Label>
            <Input
              v-model="couponForm.name"
              id="title"
              placeholder="Enter title..."
            />
            <FormMessage v-if="couponForm.errors.name" class="mt-1">
              {{ couponForm.errors.name }}
            </FormMessage>
          </div>
          <div class="space-y-2 rounded-lg">
            <Label for="coupon_code">Coupon Code</Label>
            <Input
              v-model="couponForm.coupon_code"
              id="coupon_code"
              placeholder="Enter coupon_code... ex. ABC123"
            />
            <FormMessage v-if="couponForm.errors.coupon_code" class="mt-1">
              {{ couponForm.errors.coupon_code }}
            </FormMessage>
          </div>
          <div class="space-y-2 rounded-lg">
            <Label for="status">Status</Label>
            <Select v-model="couponForm.status" class="w-full">
              <SelectTrigger>
                <SelectValue placeholder="Select a status" />
              </SelectTrigger>
              <SelectContent>
                <SelectGroup>
                  <SelectItem
                    v-for="status in ['active', 'inactive']"
                    :key="status"
                    :value="status"
                  >
                    {{ status }}
                  </SelectItem>
                </SelectGroup>
              </SelectContent>
            </Select>
            <FormMessage v-if="couponForm.errors.status" class="mt-1">
              {{ couponForm.errors.status }}
            </FormMessage>
          </div>
          <div class="space-y-2 rounded-lg">
            <Label for="quantity">Quantity</Label>
            <Input
              v-model="couponForm.quantity"
              id="quantity"
              type="number"
              placeholder="Enter quantity..."
            />
            <FormMessage v-if="couponForm.errors.quantity" class="mt-1">
              {{ couponForm.errors.quantity }}
            </FormMessage>
          </div>
          <div class="space-y-2 rounded-lg">
            <Label for="quantity">Uses Per Customer</Label>
            <Input
              v-model="couponForm.uses_per_customer"
              id="uses_per_customer"
              type="number"
              placeholder="Enter uses per customer..."
            />
            <FormMessage
              v-if="couponForm.errors.uses_per_customer"
              class="mt-1"
            >
              {{ couponForm.errors.uses_per_customer }}
            </FormMessage>
          </div>
          <div class="space-y-2 rounded-lg">
            <Label for="quantity">Discount Amount</Label>
            <Input
              v-model="couponForm.discount_amount"
              id="discount_amount"
              type="number"
              placeholder="Enter discount amount..."
            />
            <FormMessage v-if="couponForm.errors.discount_amount" class="mt-1">
              {{ couponForm.errors.discount_amount }}
            </FormMessage>
          </div>
          <div class="space-y-2 rounded-lg">
            <Label for="quantity">Start Time</Label>
            <Input
              v-model="couponForm.start_time"
              id="start_time"
              type="datetime-local"
              placeholder="Enter end time..."
            />
            <FormMessage v-if="couponForm.errors.start_time" class="mt-1">
              {{ couponForm.errors.start_time }}
            </FormMessage>
          </div>
          <div class="space-y-2 rounded-lg">
            <Label for="quantity">End Time</Label>
            <Input
              v-model="couponForm.end_time"
              id="end_time"
              type="datetime-local"
              placeholder="Enter end time..."
            />
            <FormMessage v-if="couponForm.errors.end_time" class="mt-1">
              {{ couponForm.errors.start_time }}
            </FormMessage>
          </div>
        </div>
        <div class="flex justify-end">
          <Button type="submit">{{ props.coupon ? "Update" : "Save" }}</Button>
        </div>
      </form>
    </div>
  </div>
</template>
