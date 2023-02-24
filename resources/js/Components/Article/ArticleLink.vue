<script setup>
import {onMounted, ref} from 'vue'
import {track} from '@/Components/utils'

defineEmits(['viewed'])
const props = defineProps({
  articleId: Number,
  link: String,
  storeKey: String,
})

async function handleView(viewDetails) {
  const viewedResponse = await track(viewDetails)
  // const currentArticle = props.storeKey.filter(a => a.id === viewedResponse.id)
  // currentSource.value[currentArticle.value.id].views = viewedResponse.views
}

</script>
<template>
  <a
    :href="link"
    target="_blank"
    @click="handleView({ articleId, storeKey })"
  >
    <slot />
  </a>
</template>
