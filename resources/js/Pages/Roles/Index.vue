<script lang="ts" setup>
import { Link, router, usePage } from "@inertiajs/vue3"
import { Role } from "@/types/Models/role"
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
import Badge from "@/components/ui/badge/Badge.vue"
import { Trash2Icon, SquarePen } from "lucide-vue-next"
import { Button } from "@/components/ui/button"

defineProps<{
  roles: Role[]
}>()

const handleDelete = (id: number) => {
  router.delete(`/roles/${id}`)
}
</script>

<template>
  <div class="space-y-4">
    <div class="flex items-center justify-between">
      <h1>Roles</h1>
      <Button as-child> <Link href="/roles/create"> Create Role </Link></Button>
    </div>
    <div class="overflow-x-auto rounded-md border-[1px]">
      <Table class="">
        <TableHeader>
          <TableRow>
            <TableHead class="border-r">#</TableHead>
            <TableHead class="w-[200px] border-r">Name</TableHead>
            <TableHead>Permissions</TableHead>
            <TableHead class="border-l text-center"> Action </TableHead>
          </TableRow>
        </TableHeader>
        <TableBody>
          <TableRow v-for="role in roles" :key="role.id">
            <TableCell
              class="overflow-hidden text-ellipsis whitespace-nowrap border-r"
            >
              {{ role.id }}
            </TableCell>
            <TableCell class="border-r"> {{ role.name }} </TableCell>
            <TableCell class="flex flex-wrap gap-2">
              <Badge
                v-for="permission in role.permissions"
                :key="permission.id"
              >
                {{ permission.name }}
              </Badge>
            </TableCell>
            <TableCell class="gap-2 border-l text-right">
              <div class="flex justify-end gap-2">
                <Button as-child>
                  <Link :href="`/roles/${role.id}/edit`"> <SquarePen /></Link>
                </Button>
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
                        delete this role and remove your data from our servers.
                      </AlertDialogDescription>
                    </AlertDialogHeader>
                    <AlertDialogFooter>
                      <AlertDialogCancel>Cancel</AlertDialogCancel>
                      <AlertDialogAction
                        class="bg-destructive hover:bg-red-600"
                        @click="handleDelete(role.id)"
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
