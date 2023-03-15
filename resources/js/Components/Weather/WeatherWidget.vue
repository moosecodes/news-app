<script setup>
import { onMounted, ref } from 'vue'
const currentTemp = ref([])
const locations = ['90004', '60601', '10001']
onMounted(() => {
  locations.forEach((l) => getWeather(l))
})

async function getWeather(zip = '90004') {
  let response = await axios.get(`/api/weather/${zip}`)
  currentTemp.value = [
    ...currentTemp.value,
    `${response.data.temp_f} F in ${response.data.city}, ${response.data.region}`,
  ]
}
</script>

<template>
  <div class="my-4 text-left text-sm font-bold text-gray-600">
    <slot />
    <div
      v-if="currentTemp.length"
      class="grid sm:grid-cols-1 lg:grid-cols-3"
    >
      <div
        v-for="(temp, i) in currentTemp"
        :key="i"
      >
        {{ temp }}
      </div>
    </div>
    <p v-else>
      Loading Weather...
    </p>
  </div>
</template>
