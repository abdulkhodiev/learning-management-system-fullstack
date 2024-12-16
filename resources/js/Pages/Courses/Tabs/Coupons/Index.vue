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
import { ArrowUp, CircleAlert } from "lucide-vue-next"
import Layout from "../_components/Layout.vue"
import Badge from "@/components/ui/badge/Badge.vue"
import { Coupon } from "@/types/Models/course/tabs/coupons"
import { router, usePage } from "@inertiajs/vue3"

const course = usePage().url.split("/")[2]

defineOptions({
  layout: Layout,
})

defineProps<{
  coupons: Coupon[]
}>()
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
      <Card class="flex items-center" v-for="i in 3">
        <CardContent class="flex w-full justify-between gap-4 p-4">
          <div>
            <h2>$200</h2>
            <p class="text-sm text-muted-foreground">
              Life Time Courses coupon
            </p>
          </div>
          <Badge
            variant="secondary"
            class="rounded-lg border p-2 text-green-600"
          >
            <ArrowUp /> 20%
          </Badge>
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
            <TableHead> Offer Name</TableHead>
            <TableHead>Code</TableHead>
            <TableHead>Amount</TableHead>
            <TableHead> Status </TableHead>
            <TableHead> Qty </TableHead>
            <TableHead> Redemptions </TableHead>
          </TableRow>
        </TableHeader>
        <TableBody>
          <TableRow v-for="coupon in coupons" :key="coupon.id">
            <TableCell>{{ coupon.id }}</TableCell>
            <TableCell>{{ coupon.coupon_code }}</TableCell>
            <TableCell>{{ coupon.discount_amount }}</TableCell>
            <TableCell>{{ coupon.status }} </TableCell>
            <TableCell>{{ coupon.quantity }}</TableCell>
            <TableCell> {{ coupon.uses_per_customer }} </TableCell>
          </TableRow>
        </TableBody>
      </Table>
    </div>
  </div>
</template>
