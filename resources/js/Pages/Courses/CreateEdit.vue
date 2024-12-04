<script setup lang="ts">
import { useForm } from "@inertiajs/vue3"
import Button from "@/components/ui/button/Button.vue"
import { Input } from "@/components/ui/input"
import { Category } from "@/types/Models/category"
import { computed, ref } from "vue"
import {
  TagsInput,
  TagsInputInput,
  TagsInputItem,
  TagsInputItemDelete,
  TagsInputItemText,
} from "@/components/ui/tags-input"
import { toast } from "vue-sonner"
import {
  Select,
  SelectContent,
  SelectGroup,
  SelectItem,
  SelectTrigger,
  SelectValue,
} from "@/components/ui/select"
import Textarea from "@/components/ui/textarea/Textarea.vue"

const props = defineProps<{
  categories: Category[]
}>()

const courseForm = useForm({
  title: undefined,
  description: undefined,
  image: undefined as File | undefined,
  category_id: undefined,
  price: undefined,
  languages: [] as string[],
  _method: "POST",
})

const selectedImage = ref<File | null>(null)

const previewImage = computed(() => {
  return selectedImage.value
    ? URL.createObjectURL(selectedImage.value)
    : undefined
})

const handleFileChange = (event: Event) => {
  const files = (event.target as HTMLInputElement).files
  if (files && files.length > 0) {
    selectedImage.value = files[0]
    courseForm.image = files[0]
  }
}

const handleSubmit = () => {
  courseForm.post("/courses", {
    onSuccess: () => {
      toast.success("Course created successfully")
      // Reset file input and preview
      selectedImage.value = null
    },
    onError: error => {
      console.error(error)
      toast.error("Something went wrong. Please try again later!")
    },
  })
}
</script>

<template>
  <div class="space-y-4">
    <div class="flex items-center justify-between gap-4">
      <h1>Course Create</h1>
      <Button as-child>
        <Link href="/courses"> Back </Link>
      </Button>
    </div>
    <div class="rounded-lg bg-white p-4">
      <form
        method="POST"
        enctype="multipart/form-data"
        class="space-y-4"
        @submit.prevent="handleSubmit"
      >
        <!-- Image Input -->
        <div class="w-full">
          <label
            for="image"
            class="flex cursor-pointer flex-col items-center justify-center space-y-2 text-sm font-medium text-gray-700"
          >
            <img
              :src="previewImage || 'https://via.placeholder.com/150'"
              alt=""
              class="mt-2 h-20 w-20 rounded-lg object-cover"
            />
            <p class="text-center text-xs text-gray-500">Thumbnail</p>
          </label>
          <input
            id="image"
            type="file"
            accept="image/*"
            @change="handleFileChange"
            class="hidden"
          />
          <p v-if="courseForm.errors.image" class="mt-2 text-sm text-red-600">
            {{ courseForm.errors.image }}
          </p>
        </div>

        <!-- Other Inputs -->
        <div class="grid w-full gap-4">
          <div class="w-full">
            <label for="title" class="block text-sm font-medium text-gray-700">
              Title
            </label>
            <Input
              v-model="courseForm.title"
              id="title"
              type="text"
              placeholder="Course Title"
              class="mt-1 block w-full"
            />
            <p v-if="courseForm.errors.title" class="mt-2 text-sm text-red-600">
              {{ courseForm.errors.title }}
            </p>
          </div>

          <div class="w-full">
            <label
              for="description"
              class="block text-sm font-medium text-gray-700"
            >
              Description
            </label>
            <Textarea
              v-model="courseForm.description"
              id="description"
              placeholder="Course Description"
              class="mt-1 block w-full"
            />
            <p
              v-if="courseForm.errors.description"
              class="mt-2 text-sm text-red-600"
            >
              {{ courseForm.errors.description }}
            </p>
          </div>

          <div class="w-full">
            <label for="price" class="block text-sm font-medium text-gray-700">
              Price
            </label>
            <Input
              v-model="courseForm.price"
              id="price"
              type="number"
              placeholder="Course Price"
              class="mt-1 block w-full"
            />
            <p v-if="courseForm.errors.price" class="mt-2 text-sm text-red-600">
              {{ courseForm.errors.price }}
            </p>
          </div>

          <div class="w-full">
            <label
              for="category_id"
              class="block text-sm font-medium text-gray-700"
            >
              Category
            </label>
            <Select v-model="courseForm.category_id">
              <SelectTrigger class="mt-1 w-full">
                <SelectValue placeholder="Select Category" />
              </SelectTrigger>
              <SelectContent>
                <SelectGroup>
                  <SelectItem
                    v-for="category in categories"
                    :key="category.id"
                    :value="category.id.toString()"
                  >
                    {{ category.name }}
                  </SelectItem>
                </SelectGroup>
              </SelectContent>
            </Select>
            <p
              v-if="courseForm.errors.category_id"
              class="mt-2 text-sm text-red-600"
            >
              {{ courseForm.errors.category_id }}
            </p>
          </div>

          <div class="w-full">
            <label
              for="languages"
              class="block text-sm font-medium text-gray-700"
            >
              Available Languages
            </label>
            <TagsInput
              v-model="courseForm.languages"
              id="languages"
              class="mt-1"
            >
              <TagsInputItem
                v-for="item in courseForm.languages"
                :key="item"
                :value="item"
              >
                <TagsInputItemText />
                <TagsInputItemDelete />
              </TagsInputItem>

              <TagsInputInput placeholder="Enter the languages available..." />
            </TagsInput>
            <p
              v-if="courseForm.errors.languages"
              class="mt-2 text-sm text-red-600"
            >
              {{ courseForm.errors.languages }}
            </p>
          </div>
        </div>

        <div class="flex justify-end">
          <Button type="submit">Save</Button>
        </div>
      </form>
    </div>
  </div>
</template>
