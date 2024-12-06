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
import Badge from "@/components/ui/badge/Badge.vue"
import ReviewsCard from "./_components/ReviewsCard.vue"

defineOptions({
  layout: Layout,
})

const courseReviews = {
  id: 1,
  rate: 5,
  comment:
    "Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, voluptatum.",
  user: {
    id: 1,
    first_name: "John",
    last_name: "Doe",
  },
  course: {
    id: 1,
    title:
      "Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, voluptatum.",
  },
}
</script>

<template>
  <div class="space-y-4">
    <div class="grid grid-cols-3 gap-4 md:grid-cols-6">
      <Card>
        <CardContent class="p-4">
          <p class="text-sm text-muted-foreground">Total Reviews</p>
          <h2>1000</h2>
        </CardContent>
      </Card>
      <Card class="" v-for="i in 5">
        <CardContent class="p-4">
          <p class="text-sm text-muted-foreground">{{ i }} star reviews</p>
          <div class="flex items-center gap-2">
            <h2>100</h2>
            <Badge class="rounded-md bg-red-500">{{ i }}.0</Badge>
          </div>
        </CardContent>
      </Card>
    </div>
    <div class="rounded-lg bg-white">
      <ReviewsCard :review="courseReviews" />
    </div>
  </div>
</template>
