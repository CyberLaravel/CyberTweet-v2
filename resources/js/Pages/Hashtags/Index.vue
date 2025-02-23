<template>
  <AppLayout>
    <div class="hashtags-container neon-container">
      <h1 class="neon-text text-3xl mb-6">Trending Hashtags</h1>
      
      <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div 
          v-for="hashtag in hashtags" 
          :key="hashtag.id" 
          class="hashtag-card neon-card"
        >
          <h2 class="text-xl font-bold text-neon-blue">#{{ hashtag.name }}</h2>
          <p class="text-neon-purple">{{ hashtag.tweets_count }} tweets</p>
          <Link 
            :href="route('hashtags.show', hashtag.id)" 
            class="neon-button mt-4"
          >
            View Hashtag
          </Link>
        </div>
      </div>
    </div>
  </AppLayout>
</template>

<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import { Link } from '@inertiajs/vue3'

defineProps({
  hashtags: Array
})
</script> 