<script setup lang="ts">
import {
  Table,
  TableBody,
  TableCell,
  TableHead,
  TableHeader,
  TableRow,
} from "@/components/ui/table"
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
import { CircleAlert, Trash2Icon, Pencil } from "lucide-vue-next"
import { Button } from "@/components/ui/button"
import { convertTime } from "@/lib/utils"
import { router, usePage } from "@inertiajs/vue3"
import Layout from "../../_components/Layout.vue"
import { Lesson } from "@/types/Models/course/tabs/lessons"

defineOptions({
  layout: Layout,
})

const course = usePage().url.split("/")[2]
const chapter = usePage().url.split("/")[4]

const props = defineProps<{
  lessons: Lesson[]
}>()

const handleDelete = (id: string) => {
  router.delete(`/courses/${course}/chapters/${chapter}/lessons/${id}`)
}
</script>

<template>
  <div class="space-y-4">
    <div class="flex items-center justify-between gap-3">
      <h5>{{ lessons.length }} Lessons</h5>
      <Button
        @click="
          router.get(`/courses/${course}/chapters/${chapter}/lessons/create`)
        "
        >Add Lesson</Button
      >
    </div>
    <div class="rounded-lg bg-white">
      <p
        class="flex items-center gap-2 p-4 text-sm text-red-500"
        v-if="lessons.length === 0"
      >
        <CircleAlert /> No Lesson found
      </p>
      <Table v-else>
        <TableHeader>
          <TableRow>
            <TableHead class="w-[100px]"> # </TableHead>
            <TableHead>Name</TableHead>
            <TableHead>Created at</TableHead>
            <TableHead class="w-[100px] text-center">Action</TableHead>
          </TableRow>
        </TableHeader>
        <TableBody>
          <TableRow v-for="lesson in lessons" :key="lesson.id">
            <TableCell class="font-medium">{{ lesson.id }}</TableCell>
            <TableCell>{{ lesson.name }}</TableCell>
            <TableCell>{{ convertTime(lesson.created_at) }}</TableCell>
            <TableCell
              ><div class="flex items-center justify-end gap-2">
                <Button
                  @click="
                    router.get(
                      `/courses/${course}/chapters/${chapter}/lessons/${lesson.id}/edit`
                    )
                  "
                  ><Pencil
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
                        @click="handleDelete(lesson.id.toString())"
                        >Delete</AlertDialogAction
                      >
                    </AlertDialogFooter>
                  </AlertDialogContent>
                </AlertDialog>
              </div>
            </TableCell>
          </TableRow>
        </TableBody>
      </Table>
    </div>
  </div>
</template>
