<script lang="ts" setup>
import { Input } from "@/components/ui/input"
import Separator from "@/components/ui/separator/Separator.vue"
import { User } from "@/types/Models/user"
import { ref, computed, watch } from "vue"

const searchQuery = ref("")

const props = defineProps<{
  students: User[]
  currentUser: User | null // Receive the active user from the parent
}>()

const filteredStudents = computed(() => {
  return props.students.filter(student =>
    `${student.first_name} ${student.last_name}`
      .toLowerCase()
      .includes(searchQuery.value.toLowerCase())
  )
})

console.log(props.currentUser)

const setActiveUser = (user: User) => {
  console.log("update:currentUser", user)
}
</script>

<template>
  <div class="w-full space-y-4 rounded-xl">
    <div>
      <Input
        type="search"
        placeholder="Search"
        class="bg-white"
        v-model="searchQuery"
      />
    </div>
    <div class="overflow-hidden rounded-xl bg-white">
      <div
        v-for="student in filteredStudents"
        :key="student.id"
        @click="setActiveUser(student)"
      >
        <div
          :class="
            props.currentUser && props.currentUser.id === student.id
              ? 'border-l-2 border-primary text-primary-foreground'
              : ''
          "
          class="flex cursor-pointer items-start gap-2 p-2 hover:bg-gray-100"
        >
          <img src="@/assets/Logo.png" alt="" class="h-10 w-10" />
          <div>
            <h4 class="text-lg text-black">
              {{ student.first_name }} {{ student.last_name }}
            </h4>
            <p class="text-sm text-muted-foreground">
              {{ student.role }}
            </p>
          </div>
        </div>
        <Separator />
      </div>
    </div>
  </div>
</template>
