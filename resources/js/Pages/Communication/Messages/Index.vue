<script lang="ts" setup>
import { Button } from "@/components/ui/button"
import Layout from "../_components/Layout.vue"
import MessagesBar from "./_components/MessagesBar.vue"
import Separator from "@/components/ui/separator/Separator.vue"
import Input from "@/components/ui/input/Input.vue"

defineOptions({ layout: Layout })
</script>

<template>
  <div class="flex w-full gap-3">
    <div class="w-full max-w-[400px]">
      <MessagesBar />
    </div>
    <div class="h-full w-full rounded-xl border bg-white">
      <div class="flex justify-between p-3">
        <div class="flex items-start gap-2">
          <img
            src="https://via.placeholder.com/150"
            class="h-10 w-10 rounded-full"
            alt=""
          />
          <div>
            <h4 class="text-lg font-semibold text-black">John Doe</h4>
            <p class="text-sm text-muted-foreground">Student</p>
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
      <div class="flex flex-col gap-3 p-5">
        <div class="flex max-w-[400px] flex-col gap-2 p-3">
          <p>
            Lorem, ipsum dolor sit amet consectetur adipisicing elit. Similique
            tempora quo ut hic ratione magni dolorum? Illo ut ullam architecto
            perspiciatis magnam ducimus odit, pariatur delectus debitis,
            blanditiis rerum assumenda.
          </p>
          <p class="text-sm font-medium text-muted-foreground">
            40 minutes ago
          </p>
        </div>
        <div
          class="class align-self-end ml-auto flex max-w-[400px] flex-col gap-2 rounded-xl rounded-tr-none bg-secondary p-3"
        >
          <p>
            Lorem, ipsum dolor sit amet consectetur adipisicing elit. Similique
            tempora quo ut hic ratione magni dolorum? Illo ut ullam architecto
            perspiciatis magnam ducimus odit, pariatur delectus debitis,
            blanditiis rerum assumenda.
          </p>
          <p class="text-sm font-medium">40 minutes ago</p>
        </div>
      </div>
      <Separator />
      <div class="flex items-center gap-4 p-3">
        <Input
          placeholder="Type your message"
          class="text-md w-full border-none bg-transparent shadow-none"
        />
        <Button class="text-md bg-green-500 shadow-none">Send</Button>
      </div>
    </div>
  </div>
</template>
