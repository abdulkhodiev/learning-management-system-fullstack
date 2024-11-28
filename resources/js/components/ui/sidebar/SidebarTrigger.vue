<script setup lang="ts">
import type { HTMLAttributes } from "vue"
import Button from "@/components/ui/button/Button.vue"
import { cn } from "@/lib/utils"
import { ArrowLeftFromLine } from "lucide-vue-next"
import { useSidebar } from "./utils"

const props = defineProps<{
  class?: HTMLAttributes["class"]
  icon?: boolean
}>()

const { toggleSidebar } = useSidebar()
</script>

<template>
  <Button
    data-sidebar="trigger"
    variant="ghost"
    size="icon"
    :class="cn('h-7 w-7', props.class)"
    @click="toggleSidebar"
  >
    <img src="@/assets/Logo.png" class="h-7 w-7" v-if="props.icon" />
    <ArrowLeftFromLine v-else />

    <span class="sr-only">Toggle Sidebar</span>
  </Button>
</template>
