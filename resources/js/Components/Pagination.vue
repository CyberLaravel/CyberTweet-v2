<template>
  <div v-if="links.length > 3" class="flex flex-wrap -mb-1">
    <template v-for="(link, key) in links" :key="key">
      <div
        v-if="link.url === null"
        class="mr-1 mb-1 px-4 py-3 text-sm leading-4 text-[#00FFFF]/40 border border-[#00FFFF]/10 rounded"
        v-html="link.label"
      />

      <Link
        v-else
        :href="link.url"
        class="mr-1 mb-1 px-4 py-3 text-sm leading-4 border rounded hover:bg-[#00FFFF]/10 focus:border-[#00FFFF]/40 active:bg-[#00FFFF]/20 transition duration-150 ease-in-out"
        :class="{ 
          'bg-[#00FFFF]/10 border-[#00FFFF]/40 text-[#00FFFF]': link.active,
          'border-[#00FFFF]/10 text-[#00FFFF]/70': !link.active 
        }"
        v-html="link.label"
      />
    </template>
  </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'

defineProps({
  links: Array,
});
</script> 