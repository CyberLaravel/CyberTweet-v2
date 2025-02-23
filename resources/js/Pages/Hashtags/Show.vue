<template>
  <AppLayout>
    <div class="hashtag-detail neon-container">
      <h1 class="neon-text text-3xl mb-6">#{{ hashtag.name }}</h1>
      
      <div class="tweets-container">
        <TweetList :tweets="tweets.data" />
        
        <Pagination 
          :links="tweets.links" 
          class="mt-4"
        />
      </div>
    </div>
  </AppLayout>
</template>

<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import TweetList from '@/Components/TweetList.vue'
import Pagination from '@/Components/Pagination.vue'

defineProps({
  hashtag: Object,
  tweets: Object
})
</script> 