<script lang="ts" setup>
import { Input } from "@/components/ui/input"
import Separator from "@/components/ui/separator/Separator.vue"
import { ref } from "vue"

const active = ref(true)
</script>

<template>
  <div class="w-full space-y-4 rounded-xl">
    <div>
      <Input type="search" placeholder="Search" class="bg-white" />
    </div>
    <div class="overflow-hidden rounded-xl bg-white">
      <div
        :class="
          active ? 'border-l-2 border-primary text-primary-foreground' : ''
        "
        class="flex cursor-pointer items-start gap-2 p-2"
      >
        <img src="@/assets/Logo.png" alt="" class="h-10 w-10" />
        <div>
          <h4 class="text-lg text-black">John Doe</h4>
          <p class="text-sm text-muted-foreground">Student</p>
        </div>
      </div>
      <Separator />
      <div
        :class="
          active ? 'border-l-2 border-primary text-primary-foreground' : ''
        "
        class="flex cursor-pointer items-start gap-2 p-2"
      >
        <img src="@/assets/Logo.png" alt="" class="h-10 w-10 rounded-full" />
        <div>
          <h4 class="text-lg text-black">John Doe</h4>
          <p class="text-sm text-muted-foreground">Student</p>
        </div>
      </div>
    </div>
  </div>
</template>
