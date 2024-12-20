<script setup lang="ts">
import RiseIcon from "@/assets/Icons/Commissions/RiseIcon.vue"
import { Button } from "@/components/ui/button"
import { Card, CardHeader, CardContent } from "@/components/ui/card"
import { AreaChart } from "@/components/ui/chart-area"
import { computed } from "vue"

// Define the props with proper structure
const props = defineProps<{
  commissions: {
    lifetime_commissions: number
    lifetime_received_commissions: number
    lifetime_pending_commissions: number
  }
  graph_data: {
    label: string[]
    lifetime_commissions: number[]
    lifetime_received_commissions: number[]
    lifetime_pending_commissions: number[]
  }
}>()

const data = computed(() => {
  if (!props.graph_data?.label || !Array.isArray(props.graph_data.label)) {
    console.error("Invalid graph_data format:", props.graph_data)
    return []
  }
  return props.graph_data.label.map((label: string, index: number) => ({
    name: label,
    total: props.graph_data.lifetime_commissions?.[index] || 0,
    received: props.graph_data.lifetime_received_commissions?.[index] || 0,
    pending: props.graph_data.lifetime_pending_commissions?.[index] || 0,
  }))
})

// Debugging logs to validate data structure
console.log("Graph Data Props:", props.graph_data)
console.log("Computed Data for Chart:", data.value)
</script>

<template>
  <div class="space-y-4">
    <!-- Header -->
    <div class="flex items-center justify-between">
      <h1>Dashboard</h1>
      <Button>Add Course</Button>
    </div>

    <!-- Cards -->
    <div class="flex flex-wrap gap-4">
      <div class="w-full space-y-4">
        <Card class="flex w-full max-w-[400px] items-center p-1">
          <CardHeader>
            <CardTitle>
              <RiseIcon />
            </CardTitle>
          </CardHeader>
          <CardContent class="p-4">
            <h2>{{ commissions.lifetime_commissions }}$</h2>
            <p class="text-sm text-muted-foreground">
              Lifetime Courses Commission
            </p>
          </CardContent>
        </Card>
        <Card class="flex max-w-[400px] items-center p-1">
          <CardHeader>
            <CardTitle>
              <RiseIcon />
            </CardTitle>
          </CardHeader>
          <CardContent class="p-4">
            <h2>{{ commissions.lifetime_received_commissions }}$</h2>
            <p class="text-sm text-muted-foreground">
              Lifetime Received Commission
            </p>
          </CardContent>
        </Card>
        <Card class="flex max-w-[400px] items-center p-1">
          <CardHeader>
            <CardTitle>
              <RiseIcon />
            </CardTitle>
          </CardHeader>
          <CardContent class="p-4">
            <h2>{{ commissions.lifetime_pending_commissions }}$</h2>
            <p class="text-sm text-muted-foreground">
              Lifetime Pending Commissions
            </p>
          </CardContent>
        </Card>
      </div>
    </div>

    <!-- Area Chart -->
    <div class="w-full">
      <AreaChart
        :data="data"
        index="name"
        :categories="['total', 'received', 'pending']"
      />
    </div>
  </div>
</template>
