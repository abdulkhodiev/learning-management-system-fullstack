<script lang="ts" setup>
import { Button } from "@/components/ui/button"
import { ArrowLeft } from "lucide-vue-next"
import { Head, router, useForm } from "@inertiajs/vue3"
import Input from "@/components/ui/input/Input.vue"
import Label from "@/components/ui/label/Label.vue"
import { Role } from "@/types/Models/role"
import { User } from "../../types/Models/user"
import {
  Select,
  SelectContent,
  SelectGroup,
  SelectItem,
  SelectTrigger,
  SelectValue,
} from "../../components/ui/select"
import Textarea from "@/components/ui/textarea/Textarea.vue"

const props = defineProps<{
  user?: User
  roles: Role[]
}>()

const userForm = useForm({
  first_name: props.user?.first_name || undefined,
  last_name: props.user?.last_name || undefined,
  email: props.user?.email || undefined,
  username: props.user?.username || undefined,
  password: undefined,
  role: props.user?.role?.name || undefined,
  fields: props.user?.mentor?.fields || undefined,
  experience: props.user?.mentor?.experience || undefined,
})

const handleSubmit = () => {
  if (props.user) {
    userForm.patch(`/users/${props.user.id}`)
  } else {
    userForm.post(`/users`)
  }
}
</script>

<template>
  <Head>{{ props.user ? "Edit User" : "Create User" }}</Head>
  <div class="space-y-5">
    <div class="flex items-center justify-between">
      <h1>
        {{ props.user ? "Edit" : "Create" }}
        {{
          props.user
            ? props.user.first_name + " " + props.user.last_name
            : "New"
        }}
        User
      </h1>
      <Button @click="router.get('/users')">
        Back
        <ArrowLeft />
      </Button>
    </div>

    <form class="space-y-5" @submit.prevent="handleSubmit">
      <div class="space-y-4 rounded-lg bg-white p-5">
        <div class="flex w-full flex-col gap-4 md:flex-row">
          <div class="w-full space-y-2">
            <Label for="first_name">First Name</Label>
            <Input
              v-model="userForm.first_name"
              id="first_name"
              placeholder="John"
            />
            <FormMessage
              v-if="userForm.errors.first_name"
              class="mt-1 text-sm text-red-500"
            >
              {{ userForm.errors.first_name }}
            </FormMessage>
          </div>
          <div class="w-full space-y-2">
            <Label for="last_name">Last Name</Label>
            <Input
              v-model="userForm.last_name"
              id="last_name"
              placeholder="Doe"
            />
            <p
              v-if="userForm.errors.last_name"
              class="mt-1 text-sm text-red-500"
            >
              {{ userForm.errors.last_name }}
            </p>
          </div>
        </div>
        <div class="flex w-full flex-col gap-4 md:flex-row">
          <div class="w-full space-y-2">
            <Label for="email">Email</Label>
            <Input
              v-model="userForm.email"
              id="email"
              type="email"
              placeholder="m@example.com"
            />
            <p v-if="userForm.errors.email" class="mt-1 text-sm text-red-500">
              {{ userForm.errors.email }}
            </p>
          </div>
          <div class="w-full space-y-2">
            <Label for="username">Username</Label>
            <Input
              v-model="userForm.username"
              id="username"
              placeholder="johndoe"
            />
            <p
              v-if="userForm.errors.username"
              class="mt-1 text-sm text-red-500"
            >
              {{ userForm.errors.username }}
            </p>
          </div>
        </div>

        <div class="w-full space-y-2">
          <Label for="password">Password</Label>
          <Input
            v-model="userForm.password"
            id="password"
            type="password"
            placeholder="********"
          />
          <p v-if="userForm.errors.password" class="mt-1 text-sm text-red-500">
            {{ userForm.errors.password }}
          </p>
        </div>
      </div>

      <div class="space-y-2 rounded-lg bg-white p-5">
        <h3>Assigned Role</h3>
        <div class="flex w-full items-center gap-2">
          <Select v-model="userForm.role" class="w-full">
            <SelectTrigger>
              <SelectValue placeholder="Select a role" />
            </SelectTrigger>
            <SelectContent>
              <SelectGroup>
                <SelectItem
                  v-for="role in roles"
                  :key="role.id"
                  :value="role.name"
                >
                  {{ role.name }}
                </SelectItem>
              </SelectGroup>
            </SelectContent>
          </Select>
        </div>
        <p v-if="userForm.errors.role" class="mt-1 text-sm text-red-500">
          {{ userForm.errors.role }}
        </p>
      </div>
      <div
        v-if="userForm.role === 'mentor'"
        class="space-y-4 rounded-lg bg-white p-5"
      >
        <h3>Mentor Details</h3>
        <div class="w-full space-y-2">
          <Label for="fields">Fields</Label>
          <Textarea
            v-model="userForm.fields"
            id="fields"
            placeholder="Science, Math, etc."
          />
          <p v-if="userForm.errors.fields" class="mt-1 text-sm text-red-500">
            {{ userForm.errors.fields }}
          </p>
        </div>
        <div class="w-full space-y-2">
          <Label for="experience">Experience</Label>
          <Textarea
            v-model="userForm.experience"
            id="experience"
            placeholder="5 years teaching"
          />
          <p
            v-if="userForm.errors.experience"
            class="mt-1 text-sm text-red-500"
          >
            {{ userForm.errors.experience }}
          </p>
        </div>
      </div>

      <div class="flex justify-end">
        <Button type="submit" :disabled="userForm.processing">
          <span v-if="userForm.processing">Saving...</span>
          <span v-else>Save</span>
        </Button>
      </div>
    </form>
  </div>
</template>
