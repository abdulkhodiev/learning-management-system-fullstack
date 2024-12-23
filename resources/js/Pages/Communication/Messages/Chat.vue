<script lang="ts" setup>
import { Button } from "@/components/ui/button"
import MessagesBar from "./_components/MessagesBar.vue"
import Separator from "@/components/ui/separator/Separator.vue"
import Input from "@/components/ui/input/Input.vue"
import { User } from "@/types/Models/user"
import { ref } from "vue"
import Layout from "./Layout.vue"

defineOptions({ layout: Layout })

const props = defineProps<{
  students: User[]
}>()

const currentChat = ref<User>(props.students[0])

const createChat = () => {
  if (props.students.length > 0) {
    currentChat.value = props.students[0]
  }
}
</script>

<template>
  <div class="flex w-full gap-3">
    <div class="h-full max-h-[650px] w-full rounded-xl border bg-white">
      <div v-if="currentChat" class="flex h-full flex-col">
        <!-- Chat Header -->
        <div class="flex justify-between p-3">
          <div class="flex items-start gap-2">
            <img
              src="https://via.placeholder.com/150"
              class="h-10 w-10 rounded-full"
              alt=""
            />
            <div>
              <h4 class="text-lg font-semibold text-black">
                {{ currentChat.first_name }} {{ currentChat.last_name }}
              </h4>
              <p class="text-sm text-muted-foreground">
                {{ currentChat.role }}
              </p>
            </div>
          </div>
          <div class="flex items-center gap-3">
            <Button
              class="text-md bg-transparent text-red-500 shadow-none hover:bg-red-500 hover:text-white"
              >Delete</Button
            >
            <Button
              class="text-md bg-transparent text-primary shadow-none hover:text-white"
              >Block</Button
            >
          </div>
        </div>
        <Separator />
        <!-- Chat Messages -->
        <div class="flex flex-col gap-3 p-5">
          <div class="flex max-w-[400px] flex-col gap-2 p-3">
            <p>
              Lorem, ipsum dolor sit amet consectetur adipisicing elit.
              Similique tempora quo ut hic ratione magni dolorum? Illo ut ullam
              architecto perspiciatis magnam ducimus odit, pariatur delectus
              debitis, blanditiis rerum assumenda.
            </p>
            <p class="text-sm font-medium text-muted-foreground">
              40 minutes ago
            </p>
          </div>
          <div
            class="class align-self-end ml-auto flex max-w-[400px] flex-col gap-2 rounded-xl rounded-tr-none bg-secondary p-3"
          >
            <p>
              Lorem, ipsum dolor sit amet consectetur adipisicing elit.
              Similique tempora quo ut hic ratione magni dolorum? Illo ut ullam
              architecto perspiciatis magnam ducimus odit, pariatur delectus
              debitis, blanditiis rerum assumenda.
            </p>
            <p class="text-sm font-medium">40 minutes ago</p>
          </div>
        </div>

        <!-- Chat Input -->
        <Separator />

        <div class="mt-auto flex items-center gap-4 p-3">
          <Input
            placeholder="Type your message"
            class="text-md w-full border-none bg-transparent shadow-none"
          />
          <Button class="text-md bg-green-500 shadow-none">Send</Button>
        </div>
      </div>
      <div v-else class="flex h-full items-center justify-center">
        <Button
          class="text-md bg-blue-500 text-white shadow-none"
          @click="createChat"
        >
          Start a New Chat
        </Button>
      </div>
    </div>
  </div>
</template>
