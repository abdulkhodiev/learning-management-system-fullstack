<script lang="ts" setup>
import { Button } from "@/components/ui/button"
import { ArrowLeft } from "lucide-vue-next"
import { router, useForm, usePage } from "@inertiajs/vue3"
import { Label } from "@/components/ui/label"
import { Input } from "@/components/ui/input"
import { toast } from "vue-sonner"
import { Lesson } from "@/types/Models/course/tabs/lessons"

const course = usePage().url.split("/")[2]
const chapter = usePage().url.split("/")[4]

const props = defineProps<{
  lesson?: Lesson
}>()

const lessonForm = useForm({
  name: props.lesson?.name || "",
  duration: props.lesson?.duration || "",
  video_url: props.lesson?.video_url || "",
  priority: props.lesson?.priority || "",
  course_chapter_id: chapter as string,
})

/**
 * Handles the form submission for creating or updating a lesson.
 *
 * If the `lesson` prop is provided, it will be updated by sending a PUT request
 * to the server. Otherwise, a new lesson will be created by sending a POST
 * request.
 *
 * In both cases, it will display a success or error message based on the
 * server's response.
 */
const handleSubmit = () => {
  if (props.lesson) {
    lessonForm.put(
      `/courses/${course}/chapters/${chapter}/lessons/${props.lesson.id}`,
      {
        onSuccess: () => {
          toast.success("Lesson updated successfully!")
        },
        onError: errors => {
          toast.error("Errors while updating lesson:", errors)
        },
      }
    )
  } else {
    lessonForm.post(`/courses/${course}/chapters/${chapter}/lessons`, {
      onSuccess: () => {
        toast.success("Lesson added successfully!")
      },
      onError: errors => {
        toast.error("Errors while adding lesson:", errors)
      },
    })
  }
}
</script>

<template>
  <div class="space-y-4">
    <div class="flex items-center justify-between">
      <h2>{{ props.lesson ? "Edit" : "Add" }} Lesson</h2>
      <Button
        @click="router.get(`/courses/${course}/chapters/${chapter}/lessons`)"
        ><ArrowLeft /> Back</Button
      >
    </div>
    <div class="rounded-xl bg-white p-4">
      <form class="space-y-4" @submit.prevent="handleSubmit">
        <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
          <div class="space-y-2 rounded-lg">
            <Label for="title">Title</Label>
            <Input
              v-model="lessonForm.name"
              id="title"
              placeholder="Enter title..."
            />
            <FormMessage v-if="lessonForm.errors.name" class="mt-1">
              {{ lessonForm.errors.name }}
            </FormMessage>
          </div>
          <div class="space-y-2 rounded-lg">
            <Label for="duration">Duration</Label>
            <Input
              v-model="lessonForm.duration"
              id="duration"
              placeholder="Enter duration... ex. 1:30"
            />
            <FormMessage v-if="lessonForm.errors.duration" class="mt-1">
              {{ lessonForm.errors.duration }}
            </FormMessage>
          </div>
          <div class="space-y-2 rounded-lg">
            <Label for="video_url">Video URL</Label>
            <Input
              v-model="lessonForm.video_url"
              id="video_url"
              type="url"
              placeholder="Enter video url..."
            />
            <FormMessage v-if="lessonForm.errors.video_url" class="mt-1">
              {{ lessonForm.errors.video_url }}
            </FormMessage>
          </div>
          <div class="space-y-2 rounded-lg">
            <Label for="priority">Priority</Label>
            <Input
              v-model="lessonForm.priority"
              id="priority"
              type="number"
              placeholder="Enter priority..."
            />
            <FormMessage v-if="lessonForm.errors.priority" class="mt-1">
              {{ lessonForm.errors.priority }}
            </FormMessage>
          </div>
        </div>
        <div class="flex justify-end">
          <Button type="submit">{{ props.lesson ? "Update" : "Save" }}</Button>
        </div>
      </form>
    </div>
  </div>
</template>
