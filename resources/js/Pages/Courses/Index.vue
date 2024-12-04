<script setup lang="ts">
import { Button } from "@/components/ui/button"
import {
  Card,
  CardHeader,
  CardTitle,
  CardFooter,
  CardContent,
} from "@/components/ui/card"
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

defineProps<{ courses: Course[] }>()

// const handleEdit = (id: number) => {
//   router.get(`/courses/${id}/edit`)
// }

// const handleDelete = (id: number) => {
//   router.delete(`/courses/${id}`, {
//     onSuccess: () => {
//       toast.success("Category deleted successfully")
//     },
//     onError: () => {
//       toast.error("Something went wrong. Please try again later!")
//     },
//   })
// }
</script>

<template>
  <div class="space-y-4">
    <div class="flex items-center justify-between">
      <h1>Courses</h1>
      <Button as-child>
        <Link href="/courses/create"> Create Course </Link>
      </Button>
    </div>

    <div v-if="courses.length === 0">
      <p class="rounded-lg bg-white p-4">No courses found</p>
    </div>

    <div
      class="grid justify-between gap-4 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4"
    >
      <Card
        v-for="category in courses"
        :key="category.id"
        class="flex cursor-pointer flex-col justify-between p-0"
      >
        <CardHeader class="p-2 pb-0">
          <CardTitle class="truncate text-lg">{{ category.title }}</CardTitle>
        </CardHeader>
        <CardContent> </CardContent>
        <Separator />
        <CardFooter class="flex justify-between gap-2 p-2">
          <AlertDialog class="w-full">
            <AlertDialogTrigger as-child class="w-full">
              <Button variant="destructive" class="w-full">Delete</Button>
            </AlertDialogTrigger>
            <AlertDialogContent>
              <AlertDialogHeader>
                <AlertDialogTitle>Are you absolutely sure?</AlertDialogTitle>
                <AlertDialogDescription>
                  This action cannot be undone. This will permanently delete
                  this category and remove data from our servers.
                </AlertDialogDescription>
              </AlertDialogHeader>
              <AlertDialogFooter>
                <AlertDialogCancel>Cancel</AlertDialogCancel>
                <AlertDialogAction
                  class="bg-destructive"
                  @click="handleDelete(category.id)"
                  >Delete</AlertDialogAction
                >
              </AlertDialogFooter>
            </AlertDialogContent>
          </AlertDialog>
        </CardFooter>
      </Card>
    </div>
  </div>
</template>
