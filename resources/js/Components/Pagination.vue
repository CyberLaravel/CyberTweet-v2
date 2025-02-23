<template>
  <div v-if="links.length > 3" class="pagination flex justify-center space-x-2 mt-4">
    <template v-for="(link, index) in links" :key="index">
      <Link 
        v-if="link.url"
        :href="link.url"
        :class="{
          'neon-button': true,
          'bg-neon-blue text-black': !link.active,
          'bg-neon-purple': link.active
        }"
        v-html="link.label"
      />
    </template>
  </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'

defineProps({
  links: {
    type: Array,
    required: true
  }
})
</script> 