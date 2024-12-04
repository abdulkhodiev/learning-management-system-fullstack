<script setup lang="ts">
import { Button } from "@/components/ui/button"
import { Category } from "@/types/Models/category"
import { Card, CardHeader, CardTitle, CardFooter } from "@/components/ui/card"
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

defineProps<{ categories: Category[] }>()

const handleEdit = (id: number) => {
  router.get(`/categories/${id}/edit`)
}

const handleDelete = (id: number) => {
  router.delete(`/categories/${id}`, {
    onSuccess: () => {
      toast.success("Category deleted successfully")
    },
    onError: () => {
      toast.error("Something went wrong. Please try again later!")
    },
  })
}
</script>

<template>
  <div class="space-y-4">
    <!-- Header -->
    <div class="flex items-center justify-between">
      <h1>Categories</h1>
      <Button as-child>
        <Link href="/categories/create"> Create Category </Link>
      </Button>
    </div>

    <div v-if="categories.length === 0">
      <p class="rounded-lg bg-white p-4">No Categories found</p>
    </div>

    <div
      v-else
      class="grid justify-between gap-4 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4"
    >
      <Card
        v-for="category in categories"
        :key="category.id"
        class="flex cursor-pointer flex-col justify-between p-0"
      >
        <CardHeader class="p-2 pb-0">
          <img
            :src="category.icon"
            alt="icon"
            class="h-32 w-full rounded-lg object-contain"
          />

          <CardTitle class="text-lg">{{ category.name }}</CardTitle>
        </CardHeader>
        <CardFooter class="flex justify-between gap-2 p-2">
          <Button
            @click="handleEdit(category.id)"
            variant="outline"
            class="w-full"
            >Edit</Button
          >

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
