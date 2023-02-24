<script setup>
defineProps({
  src: String,
  alt: String
})
</script>

<template>
  <img
    v-if="src"
    :src="src"
    :alt="alt"
    class="m-auto mb-4 aspect-video rounded bg-black"
  >
</template>
