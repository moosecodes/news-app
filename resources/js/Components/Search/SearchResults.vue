<script setup>
import { track } from "../utils";
import { computed } from "vue";
import { useNewsStore } from "../../stores/news";
const newsStore = useNewsStore();

const likeArticle = ({ article_id, api_source, props }) => {
  let response = axios.put("/api/like", { article_id, api_source });
  const article = props.articles[api_source].filter(
    (a) => a.id === response.data.id
  );
  article[0].favs = response.data.favs;
};

const props = defineProps({
  searchResults: Object,
});
const news = computed(() => newsStore.searchResults);
</script>

<template>
  <div class="max-sm:hidden">
    <div
      v-if="newsStore.searchResults.length"
      class="my-4 self-center text-gray-600"
    >
      <span class="my-4 self-center text-2xl">Search Results</span>
      ({{ newsStore.searchResults.length }} articles)
    </div>
    <div v-else>No search results</div>

    <section>
      <div
        class="grid gap-4 text-xl text-gray-700 sm:grid-cols-1 md:grid-cols-5"
      >
        <article v-for="(article, i) in newsStore.searchResults" :key="i">
          <a
            v-if="article"
            :href="article.link || article.url"
            target="_blank"
            @click="
              track({
                article_id: article.id,
                api_source: i,
                props,
              })
            "
          >
            <img
              v-if="article.urlToImage || article.media"
              :src="article.urlToImage || article.media"
              :alt="article.title"
              class="m-auto mb-4 aspect-video rounded"
            />
            <p class="mb-2 text-sm font-bold text-gray-600 hover:text-red-700">
              {{ article.title }}
            </p>
            <!--                <p class="text-sm text-gray-500 mt-2 hover:text-red-700 line-clamp-3">{{article.description || article.excerpt}}</p>-->
          </a>
          <div v-if="!article.notfound" class="my-4">
            <small v-if="article.favs > 0" class="mt-2 ml-4 text-gray-600">
              {{
                article.favs === 1
                  ? `${article.favs} like`
                  : `${article.favs} likes`
              }}
            </small>
            <small v-if="article.views > 0" class="mt-2 ml-4 text-gray-600">
              {{ article.views === 1 ? "view" : "views" }}
            </small>
          </div>
        </article>
      </div>
    </section>
  </div>
</template>
