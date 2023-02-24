<script setup>
import LikeButton from './LikeButton.vue'
import SaveButton from '@/Components/Article/SaveButton.vue'
import {onMounted, ref} from 'vue'
import {likeArticle, saveArticle } from '@/Components/utils'

const props = defineProps({
  article: Object,
  storeKey: String,
})
defineEmits(['liked', 'saved'])

const currentArticle = ref([])

onMounted(() => {
  currentArticle.value = props.article
})

async function handleLike(likeDetails) {
  const likedResponse = await likeArticle(likeDetails)
  currentArticle.value.favs = likedResponse.favs
}

async function handleSave(saveDetails) {
  const savedResponse = await saveArticle(saveDetails)
  currentArticle.value.saves = savedResponse.saves
}
</script>

<template>
  <div
    v-if="!currentArticle.notfound"
    class="my-8"
  >
    <LikeButton
      :article_id="currentArticle.id"
      :store-key="storeKey"
      @liked="details => handleLike(details)"
    />
    <SaveButton
      :article_id="currentArticle.id"
      :store-key="storeKey"
      @saved="details => handleSave(details)"
    />
    <small
      v-if="currentArticle.favs > 0"
      class="mt-2 ml-4 text-gray-600"
    >{{ currentArticle.favs > 1 ? `${currentArticle.favs} likes` : `${currentArticle.favs} like` }}</small>
    <small
      v-if="currentArticle.views > 0"
      class="mt-2 ml-4 text-gray-600"
    >{{ currentArticle.views > 1 ? `${currentArticle.views} views` : `${currentArticle.views} view` }}</small>
    <small
      v-if="currentArticle.saves > 0"
      class="mt-2 ml-4 text-gray-600"
    >{{ currentArticle.saves > 1 ? `${currentArticle.saves} saves` : `${currentArticle.saves} save` }}</small>
  </div>
</template>
