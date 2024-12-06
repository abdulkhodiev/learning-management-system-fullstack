<script setup lang="ts">
import StarsIcon from "@/assets/Icons/Stars/StarsIcon.vue"
import { Card, CardContent, CardFooter } from "@/components/ui/card"
import {
  DropdownMenu,
  DropdownMenuContent,
  DropdownMenuItem,
  DropdownMenuTrigger,
} from "@/components/ui/dropdown-menu"
import { Review } from "@/types/Models/course/tabs/reviews"
import { Trash } from "lucide-vue-next"

const props = defineProps<{
  review: Review
}>()
</script>

<template>
  <Card
    class="flex w-full items-start justify-between gap-[10px] rounded-2xl p-4 shadow-[0_0_8px_0_#3B82F61F]"
  >
    <CardContent class="m-0 flex flex-col justify-between gap-1.5 p-0">
      <div class="flex gap-2">
        <p class="text-sm text-muted-foreground">Rating:</p>
        <StarsIcon :rating="review.rate" />
      </div>
      <div class="flex items-baseline gap-2">
        <p class="text-sm text-muted-foreground">Course Name:</p>
        <h4 class="text-md font-medium">{{ review.course.title }}</h4>
      </div>
      <div class="flex items-center gap-2">
        <img
          src="https://via.placeholder.com/150"
          class="h-14 w-14 rounded-full"
          alt=""
        />
        <div>
          <p>{{ review.user.first_name }} {{ review.user.last_name }}</p>
          <p class="text-sm text-muted-foreground">3 days ago</p>
        </div>
      </div>

      <div class="flex gap-2">
        <p>
          {{ review.comment }}
        </p>
      </div>
    </CardContent>
    <CardFooter>
      <DropdownMenu>
        <DropdownMenuTrigger class="m-0 p-0 text-xl font-bold"
          >...</DropdownMenuTrigger
        >
        <DropdownMenuContent>
          <DropdownMenuItem><Trash class="mr-3" /> Delete</DropdownMenuItem>
        </DropdownMenuContent>
      </DropdownMenu>
    </CardFooter>
  </Card>
</template>
