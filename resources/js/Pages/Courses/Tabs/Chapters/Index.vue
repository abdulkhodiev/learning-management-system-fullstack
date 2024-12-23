<script setup lang="ts">
import Layout from "../_components/Layout.vue"
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
import { CircleAlert, Trash2Icon } from "lucide-vue-next"
import { Chapter } from "@/types/Models/chapter"
import { Button } from "@/components/ui/button"
import ChapterCreateModal from "./_components/ChapterCreateModal.vue"
import { convertTime } from "@/lib/utils"
import { toast } from "vue-sonner"
import { router, usePage } from "@inertiajs/vue3"

const course = usePage().url.split("/")[2]

defineOptions({
  layout: Layout,
})

defineProps<{
  chapters: Chapter[]
  chapter?: Chapter
}>()

const handleDelete = (id: number) => {
  router.delete(`/courses/${course}/chapters/${id}`, {
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
  <div class="space-y-4">
    <div class="flex items-center justify-between gap-3">
      <h5>{{ chapters.length }} Chapters</h5>
      <ChapterCreateModal :edit="false" />
    </div>
    <div class="rounded-lg bg-white">
      <p
        class="flex items-center gap-2 p-4 text-sm text-red-500"
        v-if="chapters.length === 0"
      >
        <CircleAlert /> No Chapters found
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
          <TableRow v-for="(chapter, index) in chapters" :key="chapter.id">
            <TableCell
              class="font-medium"
              @click="
                router.visit(
                  `/courses/${course}/chapters/${chapter.id}/lessons`
                )
              "
              >{{ index + 1 }}</TableCell
            >
            <TableCell
              @click="
                router.visit(
                  `/courses/${course}/chapters/${chapter.id}/lessons`
                )
              "
              >{{ chapter.name }}</TableCell
            >
            <TableCell
              @click="
                router.visit(
                  `/courses/${course}/chapters/${chapter.id}/lessons`
                )
              "
              >{{ convertTime(chapter.created_at) }}</TableCell
            >
            <TableCell
              ><div class="flex items-center justify-end gap-2">
                <ChapterCreateModal :edit="true" :chapter="chapter" />
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
                        @click="handleDelete(chapter.id)"
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
