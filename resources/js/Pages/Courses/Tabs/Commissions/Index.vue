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

defineOptions({
  layout: Layout,
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
      <Table class="">
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
          <TableRow>
            <TableCell class="font-medium">#16A34A</TableCell>
            <TableCell>John Doe</TableCell>
            <TableCell>Student</TableCell>
            <TableCell> 01 Jan 2023 </TableCell>
            <TableCell>Received</TableCell>
            <TableCell> $95.00 </TableCell>
          </TableRow>
        </TableBody>
      </Table>
    </div>
  </div>
</template>
