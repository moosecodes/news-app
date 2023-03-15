<script setup>

defineProps({
  article: Object,
})
</script>

<template>
  <div>
    <p class="my-2 font-bold text-indigo-900 line-clamp-2">
      <span>
        {{ article.source_id }}
      </span>
      <span class="text-xs font-bold text-gray-300 hover:text-indigo-700 ml-4">
        {{
          new Date(article.publishedAt).toLocaleDateString()
        }}
      </span>
    </p>
    <p
      class="my-2 text-xl font-bold text-red-700 hover:text-red-600 line-clamp-2"
    >
      {{ article.title }}
    </p>
    <p class="mt-2 text-sm text-gray-600 line-clamp-3">
      {{ article.description }}
    </p>
<!--      <p class="mt-2 text-sm text-gray-700 line-clamp-3 hover:text-red-700">-->
<!--          {{ article.content }}-->
<!--      </p>-->
  </div>
</template>
