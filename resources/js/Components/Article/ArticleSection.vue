<script setup>
import ArticleBase from '@/Components/Article/ArticleBase.vue'
import { useNewsStore } from '@/stores/news'
const newsStore = useNewsStore()
defineProps({
  storeKey: String,
})
</script>

<template>
  <section>
    <hr class="my-12">
    <div class="font-medium text-white my-4">
      {{ storeKey.toUpperCase() }}
    </div>

    <div
      v-if="newsStore[storeKey]"
      class="my-4 grid gap-4 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3"
    >
      <ArticleBase
        v-for="(article, i) in newsStore[storeKey]"
        :key="i"
        :article="article"
        :store-key="storeKey"
      />
    </div>
    <div v-else>
      There are no {{ storeKey }} articles currently available,
      please check back soon.
    </div>
  </section>
</template>
