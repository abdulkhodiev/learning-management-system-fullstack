<script setup lang="ts">
import Layout from "@/Layouts/Layout.vue"
import RiseIcon from "@/assets/Icons/Commissions/RiseIcon.vue"
import Badge from "@/components/ui/badge/Badge.vue"
import { Button } from "@/components/ui/button"
import {
  AlertDialog,
  AlertDialogAction,
  AlertDialogCancel,
  AlertDialogContent,
  AlertDialogDescription,
  AlertDialogFooter,
  AlertDialogHeader,
  AlertDialogTitle,
  AlertDialogTrigger,
} from "@/components/ui/alert-dialog"
import { Card, CardHeader, CardContent } from "@/components/ui/card"
import { AreaChart } from "@/components/ui/chart-area"
import { computed } from "vue"
import { router } from "@inertiajs/vue3"
import { toast } from "vue-sonner"
import { CourseWithDetails } from "@/types/Models/course"
import { PenBox, Trash2Icon } from "lucide-vue-next"

const props = defineProps<{
  commissions: {
    lifetime_commissions: number
    lifetime_received_commissions: number
    lifetime_pending_commissions: number
  }
  graph_data: {
    labels: string[]
    lifetime_commissions: number[]
    lifetime_received_commissions: number[]
    lifetime_pending_commissions: number[]
  }
  reviewsInfo: {
    number_of_reviews: number
    number_of_reviews_with_rate_1: number
    number_of_reviews_with_rate_2: number
    number_of_reviews_with_rate_3: number
    number_of_reviews_with_rate_4: number
    number_of_reviews_with_rate_5: number
  }
  courses: CourseWithDetails[]
}>()

/**
 * Deletes a course by id and shows a success or error toast message
 * @param id The id of the course to delete
 */
const handleDelete = (id: number) => {
  router.delete(`/courses/${id}`, {
    onSuccess: () => {
      toast.success("Course has been deleted successfully")
    },
    onError: () => {
      toast.error("Something went wrong. Please try again later!")
    },
  })
}

const data = computed(() => {
  if (!props.graph_data?.labels || !Array.isArray(props.graph_data.labels)) {
    console.error("Invalid graph_data format:", props.graph_data)
    return []
  }

  return props.graph_data.labels.map((label: string, index: number) => ({
    name: label,
    total: Number(props.graph_data.lifetime_commissions?.[index] || 0),
    received: Number(
      props.graph_data.lifetime_received_commissions?.[index] || 0
    ),
    pending: Number(
      props.graph_data.lifetime_pending_commissions?.[index] || 0
    ),
  }))
})
</script>

<template>
  <div class="space-y-4">
    <!-- Header -->
    <div class="flex items-center justify-between">
      <h1>Dashboard</h1>
      <Button>Add Course</Button>
    </div>

    <!-- Cards -->
    <div class="grid grid-cols-5 gap-4">
      <div class="col-span-2 h-[143px] w-full space-y-4">
        <Card class="flex h-full w-full items-center p-4">
          <CardHeader>
            <CardTitle>
              <RiseIcon />
            </CardTitle>
          </CardHeader>
          <CardContent class="p-4">
            <h2>{{ commissions.lifetime_commissions }}$</h2>
            <p class="text-sm text-muted-foreground">
              Lifetime Courses Commission
            </p>
          </CardContent>
        </Card>
        <Card class="flex h-full items-center p-4">
          <CardHeader>
            <CardTitle>
              <RiseIcon />
            </CardTitle>
          </CardHeader>
          <CardContent class="p-4">
            <h2>{{ commissions.lifetime_received_commissions }}$</h2>
            <p class="text-sm text-muted-foreground">
              Lifetime Received Commission
            </p>
          </CardContent>
        </Card>
        <Card class="flex h-full items-center p-4">
          <CardHeader>
            <CardTitle>
              <RiseIcon />
            </CardTitle>
          </CardHeader>
          <CardContent class="p-4">
            <h2>{{ commissions.lifetime_pending_commissions }}$</h2>
            <p class="text-sm text-muted-foreground">
              Lifetime Pending Commissions
            </p>
          </CardContent>
        </Card>
      </div>
      <!-- Area Chart -->
      <div class="col-span-3 h-full rounded-lg border bg-white p-4">
        <h4>Life Time Sales</h4>
        <AreaChart
          class="w-full"
          :data="data"
          :colors="['#FF0000', '#00FF00', '#0000FF']"
          :show-grid-line="false"
          index="name"
          :categories="['total', 'received', 'pending']"
        />
      </div>
    </div>

    <!-- Reviews -->
    <div class="space-y-2">
      <h2>Reviews</h2>

      <div class="grid grid-cols-3 gap-4 md:grid-cols-4 lg:grid-cols-6">
        <Card>
          <CardContent class="p-4">
            <p class="text-sm text-muted-foreground">Total Reviews</p>
            <h2>{{ reviewsInfo.number_of_reviews }}</h2>
          </CardContent>
        </Card>
        <Card>
          <CardContent class="p-4">
            <p class="text-sm text-muted-foreground">1 star reviews</p>
            <div class="flex items-center gap-2">
              <h2>{{ reviewsInfo.number_of_reviews_with_rate_1 }}</h2>
              <Badge class="rounded-md bg-red-600">1.0</Badge>
            </div>
          </CardContent>
        </Card>
        <Card>
          <CardContent class="p-4">
            <p class="text-sm text-muted-foreground">2 star reviews</p>
            <div class="flex items-center gap-2">
              <h2>{{ reviewsInfo.number_of_reviews_with_rate_2 }}</h2>
              <Badge class="rounded-md bg-red-400">2.0</Badge>
            </div>
          </CardContent>
        </Card>
        <Card>
          <CardContent class="p-4">
            <p class="text-sm text-muted-foreground">3 star reviews</p>
            <div class="flex items-center gap-2">
              <h2>{{ reviewsInfo.number_of_reviews_with_rate_3 }}</h2>
              <Badge class="rounded-md bg-yellow-500">3.0</Badge>
            </div>
          </CardContent>
        </Card>
        <Card>
          <CardContent class="p-4">
            <p class="text-sm text-muted-foreground">4 star reviews</p>
            <div class="flex items-center gap-2">
              <h2>{{ reviewsInfo.number_of_reviews_with_rate_4 }}</h2>
              <Badge class="rounded-md bg-green-400">4.0</Badge>
            </div>
          </CardContent>
        </Card>
        <Card>
          <CardContent class="p-4">
            <p class="text-sm text-muted-foreground">5 star reviews</p>
            <div class="flex items-center gap-2">
              <h2>{{ reviewsInfo.number_of_reviews_with_rate_5 }}</h2>
              <Badge class="rounded-md bg-green-600">5.0</Badge>
            </div>
          </CardContent>
        </Card>
      </div>
    </div>

    <!--Courses-->
    <div class="space-y-2">
      <h2>Courses</h2>
      <div
        class="grid justify-between gap-4 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3"
      >
        <Card
          v-for="course in courses"
          :key="course.id"
          class="flex flex-col justify-between"
        >
          <CardHeader class="p-4 pb-2">
            <div class="flex items-center justify-between gap-2">
              <Badge
                class="w-max rounded-lg border bg-secondary p-2 px-3 text-sm text-secondary-foreground"
              >
                Free</Badge
              >
              <div class="space-x-2">
                <Button
                  variant="outline"
                  @click="router.get(`/courses/${course.id}/edit`)"
                  ><PenBox
                /></Button>
                <AlertDialog>
                  <AlertDialogTrigger as-child
                    ><Button class="bg-destructive hover:bg-red-600"
                      ><Trash2Icon /></Button
                  ></AlertDialogTrigger>
                  <AlertDialogContent>
                    <AlertDialogHeader>
                      <AlertDialogTitle
                        >Are you absolutely sure?</AlertDialogTitle
                      >
                      <AlertDialogDescription>
                        This action cannot be undone. This will permanently
                        delete this course and remove your data from our
                        servers.
                      </AlertDialogDescription>
                    </AlertDialogHeader>
                    <AlertDialogFooter>
                      <AlertDialogCancel>Cancel</AlertDialogCancel>
                      <AlertDialogAction
                        class="bg-destructive hover:bg-red-600"
                        @click="handleDelete(course.id)"
                        >Delete</AlertDialogAction
                      >
                    </AlertDialogFooter>
                  </AlertDialogContent>
                </AlertDialog>
              </div>
            </div>
            <CardTitle class="truncate text-lg">{{ course.title }}</CardTitle>
          </CardHeader>
          <Separator class="mx-auto w-[90%]" />

          <CardContent
            class="grid cursor-pointer grid-cols-3 gap-4 p-4 pt-2"
            @click="router.get(`/courses/${course.id}/commissions`)"
          >
            <div>
              <h4 class="font-semibold">${{ course.price }}</h4>
              <p class="text-sm">Price</p>
            </div>
            <div>
              <h4 class="font-semibold">{{ course.number_of_chapters }}</h4>
              <p class="text-sm">Chapters</p>
            </div>
            <div>
              <h4 class="font-semibold">{{ course.number_of_orders }}</h4>
              <p class="text-sm">Orders</p>
            </div>
            <div>
              <h4 class="font-semibold">{{ course.number_of_lessons }}</h4>
              <p class="text-sm">Lessons</p>
            </div>
            <div>
              <h4 class="font-semibold">{{ course.number_of_reviews }}</h4>
              <p class="text-sm">Reviews</p>
            </div>
            <div>
              <h4 class="font-semibold">
                {{ Math.round(course.average_rating).toFixed(2) }}
              </h4>
              <p class="text-sm">Rating</p>
            </div>
          </CardContent>
        </Card>
      </div>
    </div>
  </div>
</template>
