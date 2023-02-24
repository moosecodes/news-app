<script setup>
import LaravelLogo from "./svg/LaravelLogo.vue";
import JetstreamLogo from "./svg/JetstreamLogo.vue";
import InertiaLogo from "./svg/InertiaLogo.vue";
import VueLogo from "./svg/VueLogo.vue";
import ViteLogo from "./svg/ViteLogo.vue";

defineProps({
  laravelVersion: Array,
  phpVersion: Array,
});
</script>

<template>
  <div>
    <div class="mt-8 text-2xl">This Application</div>

    <p>was built with the Laravel, Vue 3, and MySQL!</p>

    <VueLogo />
    <ViteLogo />

    <LaravelLogo :laravel-version="laravelVersion" :php-version="phpVersion" />
    <JetstreamLogo />
    <InertiaLogo />

    <div class="my-12 flex items-center justify-evenly">
      <div>MySQL</div>
      <div>Docker</div>
    </div>
  </div>
</template>
