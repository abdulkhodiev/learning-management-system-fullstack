<script setup lang="ts">
import { Button } from "@/components/ui/button"
import {
  Card,
  CardContent,
  CardDescription,
  CardFooter,
  CardHeader,
  CardTitle,
} from "@/components/ui/card"
import { Input } from "@/components/ui/input"
import { Label } from "@/components/ui/label"
import { useForm } from "@inertiajs/vue3"
import AuthLayout from "@/Layouts/AuthLayout.vue"

defineOptions({
  layout: AuthLayout,
})

const form = useForm({
  email: undefined,
  password: undefined,
})

const submit = () => {
  form.post("/login"),
    {
      onError: () => {
        form.reset("password")
      },
    }
}
</script>

<template>
  <form @submit.prevent="submit">
    <Card class="w-full max-w-sm">
      <CardHeader>
        <CardTitle class="text-2xl"> Login </CardTitle>
        <CardDescription>
          Enter your email below to login to your account.
        </CardDescription>
      </CardHeader>
      <CardContent class="grid gap-4">
        <div class="grid gap-2">
          <Label for="email">Email</Label>
          <Input
            id="email"
            type="email"
            v-model="form.email"
            placeholder="m@example.com"
            required
          />
        </div>
        <div class="grid gap-2">
          <Label for="password">Password</Label>
          <Input
            id="password"
            v-model="form.password"
            type="password"
            placeholder="********"
            required
          />
        </div>
      </CardContent>
      <CardFooter>
        <Button class="w-full"> Log in </Button>
      </CardFooter>
    </Card>
  </form>
</template>
