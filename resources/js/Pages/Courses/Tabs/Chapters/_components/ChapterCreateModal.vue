<script setup lang="ts">
import { Button } from "@/components/ui/button"
import {
  Dialog,
  DialogContent,
  DialogDescription,
  DialogHeader,
  DialogTitle,
  DialogTrigger,
} from "@/components/ui/dialog"
import { Input } from "@/components/ui/input"
import { Label } from "@/components/ui/label"
import { Chapter } from "@/types/Models/chapter"
import { useForm } from "@inertiajs/vue3"
import { usePage } from "@inertiajs/vue3"
import { Pencil } from "lucide-vue-next"
import { toast } from "vue-sonner"

const page = usePage()
const courseID = page.url.split("/")[2]

const props = defineProps<{
  chapter?: Chapter
  edit: boolean
}>()

const chapterForm = useForm({
  name: props.chapter?.name || "",
  course_id: courseID,
})

const handleSubmit = () => {
  if (!courseID || (props.edit && !props.chapter?.id)) {
    toast.error("Invalid course or chapter ID!")
    return
  }

  if (props.chapter) {
    chapterForm.put(`/courses/${courseID}/chapters/${props.chapter.id}`, {
      onSuccess: () => {
        toast.success("Chapter updated successfully!")
      },
      onError: errors => {
        console.error("Update failed:", errors)
        toast.error("Error while updating chapter. Check console for details.")
      },
    })
  } else {
    chapterForm.post(`/courses/${courseID}/chapters`, {
      onSuccess: () => {
        toast.success("Chapter added successfully!")
      },
      onError: errors => {
        toast.error("Errors while adding chapter.")
      },
    })
  }
}
</script>

<template>
  <Dialog>
    <DialogTrigger as-child
      ><Button v-if="!props.edit"> Add Chapter </Button>
      <Button v-else variant="secondary"> <Pencil /> </Button
    ></DialogTrigger>
    <DialogContent>
      <DialogHeader>
        <DialogTitle>Add Chapter</DialogTitle>
        <DialogDescription>
          Here you add a new Chapter to your course...
        </DialogDescription>
        <div>
          <form class="space-y-5" @submit.prevent="handleSubmit">
            <div class="space-y-2 rounded-lg">
              <Label for="role-name">Chapter Name</Label>
              <Input v-model="chapterForm.name" id="role-name" />
              <FormMessage v-if="chapterForm.errors.name" class="mt-1">
                {{ chapterForm.errors.name }}
              </FormMessage>
            </div>
            <div class="flex justify-end">
              <Button type="submit">Save</Button>
            </div>
          </form>
        </div>
      </DialogHeader>
    </DialogContent>
  </Dialog>
</template>
