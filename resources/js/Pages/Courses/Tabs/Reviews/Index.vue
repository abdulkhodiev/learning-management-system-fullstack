<script setup lang="ts">
import Layout from "../_components/Layout.vue"
import { Card, CardContent } from "@/components/ui/card"

import Badge from "@/components/ui/badge/Badge.vue"
import ReviewsCard from "./_components/ReviewsCard.vue"
import { Review } from "@/types/Models/course/tabs/reviews"

defineOptions({
  layout: Layout,
})

const props = defineProps<{
  reviews: Review[]
}>()
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
    <p class="text-sm text-muted-foreground" v-if="reviews.length === 0">
      No Reviews Found
    </p>
    <div class="rounded-lg bg-white" v-else>
      <ReviewsCard
        v-for="review in reviews"
        :key="review.id"
        :review="review"
      />
    </div>
  </div>
</template>
