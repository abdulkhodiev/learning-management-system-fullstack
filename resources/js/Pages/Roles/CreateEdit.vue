<script lang="ts" setup>
import { Button } from "@/components/ui/button"
import { Permission } from "@/types/Models/permission"
import { Role } from "@/types/Models/role"
import { ArrowLeft } from "lucide-vue-next"
import { router, useForm } from "@inertiajs/vue3"
import { Checkbox } from "@/components/ui/checkbox"
import Input from "@/components/ui/input/Input.vue"
import Label from "@/components/ui/label/Label.vue"

const props = defineProps<{
  role?: Role
  permissions: Permission[]
}>()

const roleForm = useForm({
  name: props.role?.name || "",
  permissions: props.role?.permissions.map(p => p.name) || [],
})

const handleCheckboxChange = (name: string) => {
  if (roleForm.permissions.includes(name)) {
    roleForm.permissions = roleForm.permissions.filter(p => p !== name)
  } else {
    roleForm.permissions.push(name)
  }
}

const handleSubmit = () => {
  if (props.role) {
    roleForm.put(`/roles/${props.role.id}`)
  } else {
    roleForm.post(`/roles`)
  }
}
</script>

<template>
  <div class="space-y-5">
    <div class="flex items-center justify-between">
      <h1>
        {{ props.role ? "Edit" : "Create" }}
        {{ props.role?.name || "New" }} Role
      </h1>
      <Button @click="router.get('/roles')">
        Back
        <ArrowLeft />
      </Button>
    </div>

    <form class="space-y-5" @submit.prevent="handleSubmit">
      <div class="space-y-2 rounded-lg bg-white p-5">
        <Label for="role-name">Role Name</Label>
        <Input v-model="roleForm.name" id="role-name" />
        <FormMessage v-if="roleForm.errors.name" class="mt-1">
          {{ roleForm.errors.name }}
        </FormMessage>
      </div>

      <div class="space-y-2 rounded-lg bg-white p-5">
        <h3>Assigned Permissions</h3>
        <div class="grid grid-cols-2 gap-2 md:grid-cols-3 lg:grid-cols-4">
          <div
            v-for="permission in permissions"
            :key="permission.name"
            class="flex items-center gap-2"
          >
            <Checkbox
              :id="`permission-${permission.name}`"
              :checked="roleForm.permissions.includes(permission.name)"
              @update:checked="handleCheckboxChange(permission.name)"
            />
            <Label :for="`permission-${permission.name}`">
              {{ permission.name }}
            </Label>
          </div>
          <FormMessage v-if="roleForm.errors.permissions" class="mt-1">
            {{ roleForm.errors.permissions }}
          </FormMessage>
        </div>
      </div>

      <div class="flex justify-end">
        <Button type="submit">Save</Button>
      </div>
    </form>
  </div>
</template>
