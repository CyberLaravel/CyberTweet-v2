<template>
  <div class="tweet-card neon-card p-4 mb-4">
    <div class="flex items-start">
      <img 
        :src="tweet.user.profile_photo_url" 
        class="w-12 h-12 rounded-full mr-4"
      />
      <div class="flex-1">
        <div class="flex justify-between items-center">
          <div>
            <h3 class="text-neon-blue font-bold">{{ tweet.user.name }}</h3>
            <p class="text-neon-purple text-sm">@{{ tweet.user.username }}</p>
          </div>
          <small class="text-neon-green">
            {{ formatDistance(tweet.created_at) }}
          </small>
        </div>
        
        <p class="mt-2 text-white">{{ tweet.content }}</p>
        
        <div v-if="tweet.hashtags && tweet.hashtags.length" class="mt-2">
          <span 
            v-for="hashtag in tweet.hashtags" 
            :key="hashtag.id" 
            class="text-neon-blue mr-2"
          >
            #{{ hashtag.name }}
          </span>
        </div>
        
        <div class="tweet-actions mt-4 flex justify-between">
          <button @click="like" class="flex items-center">
            <icon-heart :class="{ 'text-neon-red': tweet.liked }" />
            {{ tweet.likes_count }}
          </button>
          <button @click="retweet" class="flex items-center">
            <icon-retweet :class="{ 'text-neon-green': tweet.retweeted }" />
            {{ tweet.retweets_count }}
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { formatDistance } from '@/Utils/dateHelpers'
import { router } from '@inertiajs/vue3'

const props = defineProps({
  tweet: {
    type: Object,
    required: true
  },
  detailed: {
    type: Boolean,
    default: false
  }
})

const like = () => {
  router.post(`/tweets/${props.tweet.id}/like`)
}

const retweet = () => {
  router.post(`/tweets/${props.tweet.id}/retweet`)
}
</script> 