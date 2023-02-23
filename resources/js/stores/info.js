import {ref} from 'vue'
import {defineStore} from 'pinia'

export const useInfoStore = defineStore('info', () => {
  const laravelVersion = ref([])
  const phpVersion = ref([])

  return { laravelVersion, phpVersion }
})
