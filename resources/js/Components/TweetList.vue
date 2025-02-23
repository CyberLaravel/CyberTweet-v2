<template>
  <div class="tweet-list space-y-4">
    <TweetCard 
      v-for="tweet in tweets" 
      :key="tweet.id" 
      :tweet="tweet" 
    />
  </div>
</template>

<script setup>
import TweetCard from './TweetCard.vue'

defineProps({
  tweets: {
    type: Array,
    required: true
  }
})
</script> 