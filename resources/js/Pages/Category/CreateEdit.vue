<script setup lang="ts">
import Button from "@/components/ui/button/Button.vue"
import { Input } from "@/components/ui/input"
import { Category } from "@/types/Models/category"
import { router, useForm } from "@inertiajs/vue3"
import { ArrowLeft } from "lucide-vue-next"
import { computed } from "vue"
import { toast } from "vue-sonner"

const props = defineProps<{
  category?: Category
}>()

const categoryForm = useForm({
  name: props.category?.name || "",
  icon: undefined as File | undefined,
})

const previewImage = computed(() => {
  return categoryForm.icon
    ? URL.createObjectURL(categoryForm.icon)
    : props.category?.icon || ""
})

const handleSubmit = () => {
  if (props.category) {
    router.visit(`/categories/${props.category?.id}`, {
      method: "post",
      data: {
        _method: "put",
        name: categoryForm.name,
        icon: categoryForm.icon,
      },
      onSuccess: () => {
        toast.success("Category updated successfully")
      },
      onError: () => {
        toast.error("Something went wrong. Please try again later!")
      },
    })
  } else {
    categoryForm.post("/categories", {
      onSuccess: () => {
        toast.success("Category created successfully")
      },
      onError: () => {
        toast.error("Something went wrong. Please try again later!")
      },
    })
  }
}
</script>

<template>
  <div class="space-y-4">
    <div class="flex items-center justify-between gap-4">
      <h1>Category {{ props.category ? "Edit" : "Create" }}</h1>
      <Button as-child>
        <Link href="/categories"> <ArrowLeft /> Back </Link>
      </Button>
    </div>
    <div class="rounded-lg bg-white p-4">
      <form
        method="PUT"
        enctype="multipart/form-data"
        class="space-y-4"
        @submit.prevent="handleSubmit"
      >
        <div class="w-full">
          <label for="name" class="block text-sm font-medium text-gray-700">
            Name
          </label>
          <Input
            v-model="categoryForm.name"
            id="name"
            type="text"
            placeholder="Category Name"
            class="mt-1 block w-full"
          />
          <p v-if="categoryForm.errors.name" class="mt-2 text-sm text-red-600">
            {{ categoryForm.errors.name }}
          </p>
        </div>

        <div>
          <label for="icon" class="block text-sm font-medium text-gray-700">
            <img
              v-if="previewImage"
              :src="previewImage"
              alt="Preview"
              class="mt-2 h-16 w-16 object-cover"
            />
            <span v-else class="mt-2 block text-gray-500"
              >No image selected</span
            >
          </label>
          <Input
            id="icon"
            type="file"
            @input="categoryForm.icon = $event.target.files![0]"
            accept="image/*"
            hidden
            class="mt-1 block w-full"
          />
          <p v-if="categoryForm.errors.icon" class="mt-2 text-sm text-red-600">
            {{ categoryForm.errors.icon }}
          </p>
        </div>

        <div class="flex justify-end">
          <Button type="submit">Save</Button>
        </div>
      </form>
    </div>
  </div>
</template>
