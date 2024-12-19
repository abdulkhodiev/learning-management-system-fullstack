<script setup lang="ts">
import RiseIcon from "@/assets/Icons/Commissions/RiseIcon.vue"
import Layout from "../_components/Layout.vue"
import { Card, CardContent, CardHeader, CardTitle } from "@/components/ui/card"
import {
  Table,
  TableBody,
  TableCell,
  TableHead,
  TableHeader,
  TableRow,
} from "@/components/ui/table"
import { CircleAlert } from "lucide-vue-next"
import { CommissionsIndex } from "@/types/Models/course/tabs/commissions"

defineOptions({
  layout: Layout,
})

const props = defineProps<{
  commissions: CommissionsIndex
}>()

console.log(props.commissions.data)
</script>

<template>
  <div class="space-y-4">
    <div class="grid grid-cols-3 gap-4">
      <Card class="flex items-center">
        <CardHeader class="w-max">
          <CardTitle>
            <RiseIcon />
          </CardTitle>
        </CardHeader>
        <CardContent class="p-4">
          <h2>{{ props.commissions.lifetime_commissions }}$</h2>
          <p class="text-sm text-muted-foreground">
            Life Time Courses Commission
          </p>
        </CardContent>
      </Card>
      <Card class="flex items-center">
        <CardHeader class="w-max">
          <CardTitle>
            <RiseIcon />
          </CardTitle>
        </CardHeader>
        <CardContent class="p-4">
          <h2>{{ props.commissions.lifetime_received_commissions }}$</h2>
          <p class="text-sm text-muted-foreground">
            Life Time Received Commission
          </p>
        </CardContent>
      </Card>
      <Card class="flex items-center">
        <CardHeader class="w-max">
          <CardTitle>
            <RiseIcon />
          </CardTitle>
        </CardHeader>
        <CardContent class="p-4">
          <h2>{{ props.commissions.lifetime_pending_commissions }}$</h2>
          <p class="text-sm text-muted-foreground">
            Life Time Pending Commissions
          </p>
        </CardContent>
      </Card>
    </div>
    <div class="rounded-lg bg-white">
      <p
        v-if="commissions.data.length <= 0"
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
          <TableRow
            v-for="commission in commissions.data"
            :key="commission.order_id"
          >
            <TableCell class="font-medium">{{ commission.order_id }}</TableCell>
            <TableCell>{{ commission.customer }}</TableCell>
            <TableCell>{{ commission.type }}</TableCell>
            <TableCell>{{ commission.date }} </TableCell>
            <TableCell
              class="capitalize"
              :class="
                commission.status === 'received'
                  ? 'font-medium text-green-500'
                  : 'text-yellow-500'
              "
              >{{ commission.status }}</TableCell
            >
            <TableCell> {{ commission.commission }}$ </TableCell>
          </TableRow>
        </TableBody>
      </Table>
    </div>
  </div>
</template>
