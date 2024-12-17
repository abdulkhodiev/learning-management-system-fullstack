<script lang="ts" setup>
import { Review } from "@/types/Models/course/tabs/reviews"
import Layout from "../_components/Layout.vue"
import ReviewsCard from "@/Pages/Courses/Tabs/Reviews/_components/ReviewsCard.vue"

defineOptions({ layout: Layout })

defineProps<{
  reviews?: Review[]
}>()
</script>

<template>
  <div class="space-y-4">
    <!-- <p class="text-sm text-muted-foregraound" v-if="reviews.length === 0">
      No Reviews Found
    </p> -->
    <div class="rounded-lg bg-white">
      <ReviewsCard
        v-for="review in reviews"
        :key="review.id"
        :review="review"
      />
    </div>
  </div>
</template>
