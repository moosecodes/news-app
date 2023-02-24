<script setup>
import PrimaryButton from "@/Inertia/PrimaryButton.vue";

defineProps({
  article_id: Number,
    storeKey: String,
});
defineEmits(["liked"]);
</script>

<template>
  <PrimaryButton
    class="mr-2"
    @click.stop="$emit('liked', { article_id, storeKey })"
  >
    Like
  </PrimaryButton>
</template>
