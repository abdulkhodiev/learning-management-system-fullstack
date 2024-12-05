<script setup lang="ts">
import { Button } from "@/components/ui/button"
import { Card, CardHeader, CardTitle, CardContent } from "@/components/ui/card"
import { Link, router } from "@inertiajs/vue3"
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
import { toast } from "vue-sonner"
import { Course } from "@/types/Models/course"
import Separator from "@/components/ui/separator/Separator.vue"
import Badge from "@/components/ui/badge/Badge.vue"
import { PenBox, Trash2Icon } from "lucide-vue-next"

defineProps<{ courses: Course[] }>()

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
</script>

<template>
  <div class="space-y-8">
    <div class="flex items-center justify-between">
      <h1>Courses</h1>
      <Button as-child>
        <Link href="/courses/create"> Add Course </Link>
      </Button>
    </div>

    <div v-if="courses.length === 0">
      <p class="rounded-lg bg-white p-4">No courses found</p>
    </div>

    <div
      class="grid justify-between gap-4 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3"
    >
      <Card
        v-for="course in courses"
        :key="course.id"
        class="flex cursor-pointer flex-col justify-between"
        @click="router.get(`/courses/${course.id}/commissions`)"
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
                      This action cannot be undone. This will permanently delete
                      this course and remove your data from our servers.
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
        <CardContent class="grid grid-cols-3 gap-4 p-4 pt-2">
          <div>
            <h4 class="font-semibold">${{ course.price }}</h4>
            <p class="text-sm">Price</p>
          </div>
          <div>
            <h4 class="font-semibold">${{ course.price }}</h4>
            <p class="text-sm">Chapters</p>
          </div>
          <div>
            <h4 class="font-semibold">${{ course.price }}</h4>
            <p class="text-sm">Orders</p>
          </div>
          <div>
            <h4 class="font-semibold">${{ course.price }}</h4>
            <p class="text-sm">Ceritificates</p>
          </div>
          <div>
            <h4 class="font-semibold">${{ course.price }}</h4>
            <p class="text-sm">Reviews</p>
          </div>
          <div>
            <h4 class="font-semibold">${{ course.price }}</h4>
            <p class="text-sm">Add to Shelf</p>
          </div>
        </CardContent>
      </Card>
    </div>
  </div>
</template>
