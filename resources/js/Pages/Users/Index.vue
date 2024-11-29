<script lang="ts" setup>
import { Link, router, usePage } from "@inertiajs/vue3"
// import { user } from "@/types/Models/user"
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
import { Trash2Icon, SquarePen } from "lucide-vue-next"
import { Button } from "@/components/ui/button"
import { User } from "../../types/Models/user"
import Badge from "@/components/ui/badge/Badge.vue"

defineProps<{
  users: User[]
}>()

const handleDelete = (id: number) => {
  router.delete(`/users/${id}`)
}
</script>

<template>
  <div class="space-y-4">
    <div class="flex items-center justify-between">
      <h1>Users</h1>

      <Button as-child> <Link href="/users/create"> Create User </Link></Button>
    </div>

    <div class="overflow-x-auto rounded-md border-[1px]">
      <Table class="">
        <TableHeader>
          <TableRow>
            <TableHead class="border-r">#</TableHead>
            <TableHead class="border-r">Full Name</TableHead>
            <TableHead class="border-r">Role</TableHead>
            <TableHead class="border-r">Email</TableHead>
            <TableHead class="border-r">Username</TableHead>
            <TableHead class="w-[100px] border-l text-center">
              Action
            </TableHead>
          </TableRow>
        </TableHeader>
        <TableBody>
          <TableRow v-for="user in users" :key="user.id">
            <TableCell
              class="overflow-hidden text-ellipsis whitespace-nowrap border-r"
            >
              {{ user.id }}
            </TableCell>
            <TableCell class="border-r">
              {{ user.first_name + " " + user.last_name }}
            </TableCell>
            <TableCell class="flex flex-wrap gap-2 border-r"
              ><Badge> {{ user.role?.name || "N/A" }} </Badge></TableCell
            >
            <TableCell class="border-r"> {{ user.email }} </TableCell>
            <TableCell class="border-r"> {{ user.username }} </TableCell>

            <TableCell class="gap-2 border-l text-right">
              <div class="flex justify-end gap-2">
                <Button as-child>
                  <Link :href="`/users/${user.id}/edit`"> <SquarePen /></Link>
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
                        delete this user and remove your data from our servers.
                      </AlertDialogDescription>
                    </AlertDialogHeader>
                    <AlertDialogFooter>
                      <AlertDialogCancel>Cancel</AlertDialogCancel>
                      <AlertDialogAction
                        class="bg-destructive hover:bg-red-600"
                        @click="handleDelete(user.id)"
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
