<script lang="ts" setup>
import { Link, router } from "@inertiajs/vue3"
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
import { Trash2Icon } from "lucide-vue-next"
import { Button } from "@/components/ui/button"
import { Permission } from "@/types/Models/permission"

defineProps<{
  permissions: Permission[]
}>()

const handleDelete = (id: number) => {
  router.delete(`/permissions/${id}`)
}
</script>

<template>
  <div class="space-y-4">
    <div class="flex items-center justify-between">
      <h1>Permissions</h1>
      <!-- <Button as-child> <Link href="/permissions/create"> Create Role </Link></Button> -->
    </div>
    <div class="overflow-x-auto rounded-md border-[1px]">
      <Table class="">
        <TableHeader>
          <TableRow>
            <TableHead class="w-[100px] border-r">#</TableHead>
            <TableHead class="border-r">Name</TableHead>
            <TableHead class="w-[100px] border-l text-center">
              Action
            </TableHead>
          </TableRow>
        </TableHeader>
        <TableBody>
          <TableRow v-for="permission in permissions" :key="permission.id">
            <TableCell
              class="overflow-hidden text-ellipsis whitespace-nowrap border-r"
            >
              {{ permission.id }}
            </TableCell>
            <TableCell class="border-r"> {{ permission.name }} </TableCell>
            <TableCell class="gap-2 border-l text-center">
              <div class="flex justify-center gap-2">
                <AlertDialog>
                  <AlertDialogTrigger
                    ><Button variant="destructive">
                      <Trash2Icon class="size-5" /> </Button
                  ></AlertDialogTrigger>
                  <AlertDialogContent>
                    <AlertDialogHeader>
                      <AlertDialogTitle
                        >Are you absolutely sure?</AlertDialogTitle
                      >
                      <AlertDialogDescription>
                        This action cannot be undone. This will permanently
                        delete this permission and remove your data from our
                        servers.
                      </AlertDialogDescription>
                    </AlertDialogHeader>
                    <AlertDialogFooter>
                      <AlertDialogCancel>Cancel</AlertDialogCancel>
                      <AlertDialogAction
                        class="bg-destructive hover:bg-red-600"
                        @click="handleDelete(permission.id)"
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
