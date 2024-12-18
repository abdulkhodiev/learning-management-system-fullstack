<script lang="ts" setup>
import { Review } from "@/types/Models/course/tabs/reviews"
import Layout from "../_components/Layout.vue"
import ReviewsCard from "@/Pages/Courses/Tabs/Reviews/_components/ReviewsCard.vue"
import { CircleAlert } from "lucide-vue-next"

defineOptions({ layout: Layout })

defineProps<{
  reviews: Review[]
}>()
</script>

<template>
  <div class="space-y-4">
    <p
      class="text-muted-foregraound flex items-center gap-3 rounded-xl bg-white p-2 text-sm text-red-500"
      v-if="reviews.length === 0"
    >
      <CircleAlert /> No Reviews Found
    </p>
    <div class="rounded-lg bg-white">
      <ReviewsCard
        v-for="review in reviews"
        :key="review.id"
        :review="review"
      />
    </div>
  </div>
</template>
