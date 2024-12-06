<script lang="ts" setup>
import { computed, defineProps } from "vue"

const props = defineProps({
  rating: {
    type: Number,
    required: true,
  },
})

// Calculate the percentage width for the filled stars based on the rating
const ratingWidth = computed(() => `${(props.rating / 5) * 100}%`)
</script>

<template>
  <div class="star-rating">
    <!-- Empty stars background -->
    <div class="stars-empty">
      <svg
        width="101"
        height="20"
        viewBox="0 0 101 20"
        xmlns="http://www.w3.org/2000/svg"
      >
        <g fill="#E0F2FE">
          <path
            v-for="index in 5"
            :key="index"
            :transform="`translate(${(index - 1) * 20}, 0)`"
            d="M10.1542 1.06438C10.263 0.72936 10.737 0.72936 10.8458 1.06438L12.6635 6.65856C12.7122 6.80839 12.8518 6.90983 13.0093 6.90983H18.8914C19.2437 6.90983 19.3901 7.3606 19.1051 7.56765L14.3465 11.025C14.219 11.1176 14.1657 11.2818 14.2144 11.4316L16.032 17.0258C16.1409 17.3608 15.7574 17.6394 15.4724 17.4323L10.7137 13.975C10.5863 13.8824 10.4137 13.8824 10.2863 13.975L5.52757 17.4323C5.24258 17.6394 4.85913 17.3608 4.96799 17.0258L6.78565 11.4316C6.83433 11.2818 6.781 11.1176 6.65355 11.025L1.89485 7.56765C1.60987 7.3606 1.75633 6.90983 2.10859 6.90983H7.99066C8.1482 6.90983 8.28782 6.80839 8.3365 6.65856L10.1542 1.06438Z"
          />
        </g>
      </svg>
    </div>

    <!-- Filled stars foreground -->
    <div class="stars-filled" :style="{ width: ratingWidth }">
      <svg
        width="101"
        height="20"
        viewBox="0 0 101 20"
        xmlns="http://www.w3.org/2000/svg"
      >
        <g fill="#EAB308">
          <path
            v-for="index in 5"
            :key="index"
            :transform="`translate(${(index - 1) * 20}, 0)`"
            d="M10.1542 1.06438C10.263 0.72936 10.737 0.72936 10.8458 1.06438L12.6635 6.65856C12.7122 6.80839 12.8518 6.90983 13.0093 6.90983H18.8914C19.2437 6.90983 19.3901 7.3606 19.1051 7.56765L14.3465 11.025C14.219 11.1176 14.1657 11.2818 14.2144 11.4316L16.032 17.0258C16.1409 17.3608 15.7574 17.6394 15.4724 17.4323L10.7137 13.975C10.5863 13.8824 10.4137 13.8824 10.2863 13.975L5.52757 17.4323C5.24258 17.6394 4.85913 17.3608 4.96799 17.0258L6.78565 11.4316C6.83433 11.2818 6.781 11.1176 6.65355 11.025L1.89485 7.56765C1.60987 7.3606 1.75633 6.90983 2.10859 6.90983H7.99066C8.1482 6.90983 8.28782 6.80839 8.3365 6.65856L10.1542 1.06438Z"
          />
        </g>
      </svg>
    </div>
  </div>
</template>

<style scoped>
.star-rating {
  position: relative;
  display: inline-block;
  width: 101px;
  height: 20px;
}

.stars-empty {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  overflow: hidden;
}

.stars-filled {
  position: absolute;
  top: 0;
  left: 0;
  height: 100%;
  overflow: hidden;
  white-space: nowrap;
  display: block;
}
</style>
