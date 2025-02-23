<template>
  <AppLayout>
    <div class="tweets-container neon-container">
      <TweetComposer />
      
      <div class="mt-6">
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
import TweetComposer from '@/Components/TweetComposer.vue'
import Pagination from '@/Components/Pagination.vue'

defineProps({
  tweets: Object
})
</script> 