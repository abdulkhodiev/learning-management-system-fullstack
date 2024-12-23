<script setup lang="ts">
import { Button } from "@/components/ui/button"
import { Card, CardContent } from "@/components/ui/card"
import {
  Table,
  TableBody,
  TableCell,
  TableHead,
  TableHeader,
  TableRow,
} from "@/components/ui/table"
import { CircleAlert, Pencil, Trash2Icon } from "lucide-vue-next"
import Layout from "../_components/Layout.vue"
import { Coupon } from "@/types/Models/course/tabs/coupons"
import { router, usePage } from "@inertiajs/vue3"
import {
  AlertDialog,
  AlertDialogAction,
  AlertDialogCancel,
  AlertDialogContent,
  AlertDialogDescription,
  AlertDialogFooter,
  AlertDialogHeader,
  AlertDialogTitle,
  AlertDialogTrigger,
} from "@/components/ui/alert-dialog"

const course = usePage().url.split("/")[2]

defineOptions({
  layout: Layout,
})

defineProps<{
  coupons: Coupon[]
  couponStatistics: {
    couponCount: number
    couponAmount: number
    averageAmount: number
  }
}>()

const handleDelete = (id: string) => {
  router.delete(`/coupons/${id}`)
}
</script>

<template>
  <div class="space-y-4">
    <div class="flex items-center justify-between gap-4">
      <h2>Coupons</h2>
      <Button @click="router.get(`/courses/${course}/coupons/create`)"
        >Create Coupon</Button
      >
    </div>
    <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3">
      <Card class="flex items-center">
        <CardContent class="flex w-full justify-between gap-4 p-4">
          <div>
            <h2>{{ couponStatistics.couponCount }}</h2>
            <p class="text-sm text-muted-foreground">Total Number of Coupons</p>
          </div>
        </CardContent>
      </Card>
      <Card class="flex items-center">
        <CardContent class="flex w-full justify-between gap-4 p-4">
          <div>
            <h2>${{ couponStatistics.couponAmount }}</h2>
            <p class="text-sm text-muted-foreground">Total Price of Coupons</p>
          </div>
        </CardContent>
      </Card>
      <Card class="flex items-center">
        <CardContent class="flex w-full justify-between gap-4 p-4">
          <div>
            <h2>${{ couponStatistics.averageAmount.toFixed(2) }}</h2>
            <p class="text-sm text-muted-foreground">
              Average Price of Coupons
            </p>
          </div>
        </CardContent>
      </Card>
    </div>
    <div class="rounded-lg bg-white">
      <p
        v-if="coupons.length <= 0"
        class="flex items-center gap-2 p-4 text-sm text-red-500"
      >
        <CircleAlert /> No coupons found
      </p>
      <Table v-else>
        <TableHeader>
          <TableRow>
            <TableHead>#</TableHead>
            <TableHead> Offer Name</TableHead>
            <TableHead>Code</TableHead>
            <TableHead>Amount</TableHead>
            <TableHead> Status </TableHead>
            <TableHead> Qty </TableHead>
            <TableHead class="text-center"> Uses Per Customer </TableHead>
            <TableHead class="text-center">Actions</TableHead>
          </TableRow>
        </TableHeader>
        <TableBody>
          <TableRow v-for="(coupon, index) in coupons" :key="coupon.id">
            <TableCell>{{ index + 1 }}</TableCell>
            <TableCell class="truncate">{{ coupon.name }}</TableCell>
            <TableCell>{{ coupon.coupon_code }}</TableCell>
            <TableCell>{{ coupon.discount_amount }}</TableCell>
            <TableCell>{{ coupon.status }} </TableCell>
            <TableCell>{{ coupon.quantity }}</TableCell>
            <TableCell class="text-center">
              {{ coupon.uses_per_customer }}
            </TableCell>
            <TableCell class="flex flex-nowrap text-center">
              <Button
                class="mr-2"
                @click="router.get(`/coupons/${coupon.id}/edit`)"
                ><Pencil
              /></Button>
              <AlertDialog>
                <AlertDialogTrigger as-child
                  ><Button class="bg-destructive hover:bg-red-600"
                    ><Trash2Icon /></Button
                ></AlertDialogTrigger>
                <AlertDialogContent>
                  <AlertDialogHeader>
                    <AlertDialogTitle
                      >Are you absolutely sure?</AlertDialogTitle
                    >
                    <AlertDialogDescription>
                      This action cannot be undone. This will permanently delete
                      this course and remove your data from our servers.
                    </AlertDialogDescription>
                  </AlertDialogHeader>
                  <AlertDialogFooter>
                    <AlertDialogCancel>Cancel</AlertDialogCancel>
                    <AlertDialogAction
                      class="bg-destructive hover:bg-red-600"
                      @click="handleDelete(coupon.id)"
                      >Delete</AlertDialogAction
                    >
                  </AlertDialogFooter>
                </AlertDialogContent>
              </AlertDialog>
            </TableCell>
          </TableRow>
        </TableBody>
      </Table>
    </div>
  </div>
</template>
