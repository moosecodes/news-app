<script setup>
import ArticleLink from '@/Components/Article/ArticleLink.vue'
import ArticleImage from '@/Components/Article/ArticleImage.vue'
import LikesAndViews from '@/Components/Article/LikesAndViews.vue'
import ArticleMetaData from '@/Components/Article/ArticleMetaData.vue'
import {onMounted, ref} from 'vue'

const props = defineProps({
  article: Object,
  storeKey: String
})

</script>

<template>
  <article>
    <div>
      <ArticleLink
        :article-id="article.id"
        :link="article.link"
        :store-key="storeKey"
      >
        <ArticleImage
            :src="article.image_url || 'https://picsum.photos/700/500'"
            :alt="article.title"
        />
        <ArticleMetaData :article="article"/>
      </ArticleLink>

      <LikesAndViews
        :article="article"
        :store-key="storeKey"
      />
    </div>
  </article>
</template>
