<template>
  <AppLayout>
    <div class="tweet-detail neon-container">
      <TweetCard 
        :tweet="tweet" 
        :detailed="true" 
      />
      
      <div class="comments-section mt-6">
        <h2 class="neon-text text-2xl mb-4">Comments</h2>
        <!-- Implement comment section -->
      </div>
    </div>
  </AppLayout>
</template>

<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import TweetCard from '@/Components/TweetCard.vue'

defineProps({
  tweet: Object
})
</script> 