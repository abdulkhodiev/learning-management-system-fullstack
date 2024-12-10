<script setup lang="ts">
import RiseIcon from "@/assets/Icons/Commissions/RiseIcon.vue"
import Layout from "../_components/Layout.vue"
import { Card, CardContent, CardHeader, CardTitle } from "@/components/ui/card"
import {
  Table,
  TableBody,
  TableCaption,
  TableCell,
  TableHead,
  TableHeader,
  TableRow,
} from "@/components/ui/table"
import { CircleAlert } from "lucide-vue-next"

defineOptions({
  layout: Layout,
})

defineProps({
  commissions: {
    type: Array,
    required: true,
  },
})
</script>

<template>
  <div class="space-y-4">
    <div class="grid grid-cols-3 gap-4">
      <Card class="flex items-center" v-for="i in 3">
        <CardHeader class="w-max">
          <CardTitle>
            <RiseIcon />
          </CardTitle>
        </CardHeader>
        <CardContent class="p-4">
          <h2>$1K</h2>
          <p class="text-sm text-muted-foreground">
            Life Time Courses Commission
          </p>
        </CardContent>
      </Card>
    </div>
    <div class="rounded-lg bg-white">
      <p
        v-if="commissions.length <= 0"
        class="flex items-center gap-2 p-4 text-sm text-red-500"
      >
        <CircleAlert /> No Commissions found
      </p>
      <Table v-else>
        <TableHeader>
          <TableRow>
            <TableHead class="w-[100px]"> Order ID </TableHead>
            <TableHead>Customer</TableHead>
            <TableHead>Type</TableHead>
            <TableHead> Date </TableHead>
            <TableHead> Status </TableHead>
            <TableHead> Commission </TableHead>
          </TableRow>
        </TableHeader>
        <TableBody>
          <TableRow v-for="commission in commissions" :key="commission.id">
            <TableCell class="font-medium">{{ commission.id }}</TableCell>
            <TableCell>{{ commission.customer }}</TableCell>
            <TableCell>{{ commission.type }}</TableCell>
            <TableCell>{{ commission.date }} </TableCell>
            <TableCell>{{ commission.status }}</TableCell>
            <TableCell> {{ commission.commission }} </TableCell>
          </TableRow>
        </TableBody>
      </Table>
    </div>
  </div>
</template>
