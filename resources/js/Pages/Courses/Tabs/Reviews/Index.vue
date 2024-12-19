<script setup lang="ts">
import Layout from "../_components/Layout.vue"
import { Card, CardContent } from "@/components/ui/card"

import Badge from "@/components/ui/badge/Badge.vue"
import ReviewsCard from "./_components/ReviewsCard.vue"
import { Review, TotalInfo } from "@/types/Models/course/tabs/reviews"

defineOptions({
  layout: Layout,
})

const props = defineProps<{
  reviews: Review[]
  totalInfo: TotalInfo
}>()
</script>

<template>
  <div class="space-y-4">
    <div class="grid grid-cols-3 gap-4 md:grid-cols-4 lg:grid-cols-6">
      <Card>
        <CardContent class="p-4">
          <p class="text-sm text-muted-foreground">Total Reviews</p>
          <h2>{{ totalInfo.number_of_reviews }}</h2>
        </CardContent>
      </Card>
      <Card>
        <CardContent class="p-4">
          <p class="text-sm text-muted-foreground">1 star reviews</p>
          <div class="flex items-center gap-2">
            <h2>{{ totalInfo.number_of_reviews_with_rate_1 }}</h2>
            <Badge class="rounded-md bg-red-600">1.0</Badge>
          </div>
        </CardContent>
      </Card>
      <Card>
        <CardContent class="p-4">
          <p class="text-sm text-muted-foreground">2 star reviews</p>
          <div class="flex items-center gap-2">
            <h2>{{ totalInfo.number_of_reviews_with_rate_2 }}</h2>
            <Badge class="rounded-md bg-red-400">2.0</Badge>
          </div>
        </CardContent>
      </Card>
      <Card>
        <CardContent class="p-4">
          <p class="text-sm text-muted-foreground">3 star reviews</p>
          <div class="flex items-center gap-2">
            <h2>{{ totalInfo.number_of_reviews_with_rate_3 }}</h2>
            <Badge class="rounded-md bg-yellow-500">3.0</Badge>
          </div>
        </CardContent>
      </Card>
      <Card>
        <CardContent class="p-4">
          <p class="text-sm text-muted-foreground">4 star reviews</p>
          <div class="flex items-center gap-2">
            <h2>{{ totalInfo.number_of_reviews_with_rate_4 }}</h2>
            <Badge class="rounded-md bg-green-400">4.0</Badge>
          </div>
        </CardContent>
      </Card>
      <Card>
        <CardContent class="p-4">
          <p class="text-sm text-muted-foreground">5 star reviews</p>
          <div class="flex items-center gap-2">
            <h2>{{ totalInfo.number_of_reviews_with_rate_5 }}</h2>
            <Badge class="rounded-md bg-green-600">5.0</Badge>
          </div>
        </CardContent>
      </Card>
    </div>
    <p class="text-sm text-muted-foreground" v-if="reviews.length === 0">
      No Reviews Found
    </p>
    <div class="space-y-4 rounded-lg" v-else>
      <ReviewsCard
        v-for="review in reviews"
        :key="review.id"
        :review="review"
      />
    </div>
  </div>
</template>
