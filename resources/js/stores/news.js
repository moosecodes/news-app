import {ref} from 'vue'
import {defineStore} from 'pinia'

export const useNewsStore = defineStore('news', () => {
  const searchResults = ref([])
  const trending = ref([])
  const newest = ref([])

  return { searchResults, newest, trending }
})
