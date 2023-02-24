<script setup>

defineProps({
  article: Object,
})
</script>

<template>
  <div>
    <p class="my-2 font-bold text-red-500 line-clamp-2 hover:text-red-700">
      <span>
        {{ article.source }}
      </span>
      <span class="text-xs font-semibold text-gray-300 hover:text-red-700 ml-4">
        {{
          new Date(article.publishedAt).toLocaleDateString()
        }}
      </span>
    </p>
    <p
      class="my-2 text-xl font-bold text-red-500 line-clamp-2 hover:text-red-700"
    >
      {{ article.title }}
    </p>
    <p class="mt-2 text-sm dark:text-white line-clamp-3 hover:text-red-700">
      {{ article.description }}
    </p>
<!--      <p class="mt-2 text-sm text-gray-700 line-clamp-3 hover:text-red-700">-->
<!--          {{ article.content }}-->
<!--      </p>-->
  </div>
</template>
