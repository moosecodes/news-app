import {ref} from 'vue'
import {defineStore} from 'pinia'

export const useCartStore = defineStore('cart', () => {
  const items = ref([])
  const total = ref([])

  return { items, total }
})
