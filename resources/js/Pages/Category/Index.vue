<script setup lang="ts">
import { Button } from "@/components/ui/button"
import { Category } from "@/types/Models/category"
import { Card, CardHeader, CardTitle } from "@/components/ui/card"
import { Link, router } from "@inertiajs/vue3"

defineProps<{ categories: Category[] }>()

// Function to handle navigation to the edit page
const handleEdit = (id: number) => {
  router.get(`/categories/${id}/edit`)
}

// Function to handle deletion
const handleDelete = (id: number) => {
  if (confirm("Are you sure you want to delete this category?")) {
    router.delete(`/categories/${id}`, {
      onSuccess: () => {
        alert("Category deleted successfully!")
      },
      onError: () => {
        alert("Failed to delete the category.")
      },
    })
  }
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

    <!-- No Categories Message -->
    <div v-if="categories.length === 0">
      <p class="rounded-lg bg-white p-4">No Categories found</p>
    </div>

    <!-- Category Cards -->
    <div
      v-else
      class="grid justify-between gap-4 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4"
    >
      <Card
        v-for="category in categories"
        :key="category.id"
        class="cursor-pointer"
      >
        <CardHeader>
          <img
            :src="`../../../../` + `storage/${category.icon}`"
            alt="icon"
            class="h-32 w-full rounded-lg object-cover"
          />
          <p>{{ category.icon }}</p>

          <CardTitle>{{ category.name }}</CardTitle>
        </CardHeader>
        <div class="flex justify-between p-4">
          <Button @click="handleEdit(category.id)" variant="outline"
            >Edit</Button
          >
          <Button @click="handleDelete(category.id)" variant="destructive"
            >Delete</Button
          >
        </div>
      </Card>
    </div>
  </div>
</template>
