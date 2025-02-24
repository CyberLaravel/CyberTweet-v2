<template>
  <div class="space-y-4">
    <div v-for="tweet in tweets.data" :key="tweet.id" class="relative">

      <!-- Neon Border Effect -->
      <div class="absolute -inset-[1px] bg-gradient-to-r from-[#00FFFF] via-[#FF00FF] to-[#00FFFF] rounded-lg opacity-30 blur"></div>
      
      <div class="relative bg-[#001122]/95 backdrop-blur-xl border border-[#00FFFF]/20 rounded-lg p-6 shadow-[0_0_50px_rgba(0,255,255,0.1)]">
        <!-- Corner Accents -->
        <div class="absolute top-0 left-0 w-2 h-2 border-l-2 border-t-2 border-[#00FFFF]/50"></div>
        <div class="absolute top-0 right-0 w-2 h-2 border-r-2 border-t-2 border-[#00FFFF]/50"></div>
        <div class="absolute bottom-0 left-0 w-2 h-2 border-l-2 border-b-2 border-[#00FFFF]/50"></div>
        <div class="absolute bottom-0 right-0 w-2 h-2 border-r-2 border-b-2 border-[#00FFFF]/50"></div>

        <!-- User Info -->
        <div class="flex items-center space-x-4">
          <Link :href="route('users.show', tweet.user.username)">
            <img :src="tweet.user.profile_photo_url" :alt="tweet.user.name" class="w-12 h-12 rounded-full border-2 border-[#00FFFF] shadow-[0_0_10px_rgba(0,255,255,0.3)]">
          </Link>
          <div>
            <Link :href="route('users.show', tweet.user.username)" class="text-white font-medium hover:text-[#00FFFF] transition-colors">
              {{ tweet.user.name }}
            </Link>
            <div class="text-[#00FFFF]/60 text-sm">@{{ tweet.user.username }}</div>
          </div>
          <div class="text-[#00FFFF]/40 text-sm ml-auto">
            {{ formatDistanceToNow(new Date(tweet.created_at), { addSuffix: true }) }}
          </div>
        </div>

        <!-- Tweet Content -->
        <div class="mt-4 text-white/90">
          {{ tweet.content }}
        </div>

        <!-- Hashtags -->
        <div v-if="tweet.hashtags && tweet.hashtags.length > 0" class="mt-4 flex flex-wrap gap-2">
          <Link
            v-for="hashtag in tweet.hashtags"
            :key="hashtag"
            :href="route('hashtags.show', hashtag)"
            class="text-[#00FFFF] hover:text-[#FF00FF] text-sm transition-colors"
          >
            #{{ hashtag }}
          </Link>
        </div>

        <!-- Action Buttons -->
        <div class="mt-4 flex items-center space-x-6 border-t border-[#00FFFF]/10 pt-4">
          <!-- Like Button -->
          <button 
            @click="like(tweet)"
            class="flex items-center space-x-2 transition-all duration-300 group relative"
            :class="{
              'text-[#FF00FF] scale-110 shadow-[0_0_15px_rgba(255,0,255,0.5)]': tweetStates[tweet.id]?.liked,
              'text-[#00FFFF]/60 hover:text-[#FF00FF] hover:scale-105': !tweetStates[tweet.id]?.liked
            }"
          >
            <svg class="w-5 h-5" :class="{ 'filter drop-shadow-[0_0_3px_rgba(255,0,255,0.7)]': tweetStates[tweet.id]?.liked }" :fill="tweetStates[tweet.id]?.liked ? 'currentColor' : 'none'" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
            </svg>
            <span class="text-sm" :class="{ 'font-bold': tweetStates[tweet.id]?.liked }">{{ tweetStates[tweet.id]?.likes_count || 0 }}</span>
            <div v-if="tweetStates[tweet.id]?.liked" class="absolute inset-0 bg-[#FF00FF]/10 rounded-full blur-lg animate-pulse"></div>
          </button>

          <!-- Comment Button -->
          <button 
            @click="toggleComments(tweet)"
            class="flex items-center space-x-2 transition-all duration-300 group relative"
            :class="{
              'text-[#FF00FF] scale-110 shadow-[0_0_15px_rgba(255,0,255,0.5)]': tweetStates[tweet.id]?.comments_count > 0,
              'text-[#00FFFF]/60 hover:text-[#FF00FF] hover:scale-105': !tweetStates[tweet.id]?.comments_count
            }"
          >
            <svg class="w-5 h-5" :class="{ 'filter drop-shadow-[0_0_3px_rgba(255,0,255,0.7)]': tweetStates[tweet.id]?.comments_count > 0 }" :fill="tweetStates[tweet.id]?.comments_count > 0 ? 'currentColor' : 'none'" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
            </svg>
            <span class="text-sm" :class="{ 'font-bold': tweetStates[tweet.id]?.comments_count > 0 }">{{ tweetStates[tweet.id]?.comments_count || 0 }}</span>
            <div v-if="tweetStates[tweet.id]?.comments_count > 0" class="absolute inset-0 bg-[#FF00FF]/10 rounded-full blur-lg animate-pulse"></div>
          </button>

          <!-- Retweet Button -->
          <button 
            @click="retweet(tweet)"
            class="flex items-center space-x-2 transition-all duration-300 group relative"
            :class="{
              'text-[#FF00FF] scale-110 shadow-[0_0_15px_rgba(255,0,255,0.5)]': tweetStates[tweet.id]?.is_retweeted,
              'text-[#00FFFF]/60 hover:text-[#FF00FF] hover:scale-105': !tweetStates[tweet.id]?.is_retweeted
            }"
          >
            <svg class="w-5 h-5" 
              :class="{ 'filter drop-shadow-[0_0_3px_rgba(255,0,255,0.7)]': tweetStates[tweet.id]?.is_retweeted }" 
              :fill="tweetStates[tweet.id]?.is_retweeted ? 'currentColor' : 'none'" 
              stroke="currentColor" 
              viewBox="0 0 24 24"
            >
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
            </svg>
            <span class="text-sm" :class="{ 'font-bold': tweetStates[tweet.id]?.is_retweeted }">
              {{ tweetStates[tweet.id]?.retweets_count || 0 }}
            </span>
            <div v-if="tweetStates[tweet.id]?.is_retweeted" class="absolute inset-0 bg-[#FF00FF]/10 rounded-full blur-lg animate-pulse"></div>
          </button>
        </div>
      </div>

      <!-- Comments Section -->
      <div v-if="tweetStates[tweet.id]?.show_comments" class="mt-4 space-y-4 border-t border-[#00FFFF]/10 pt-4">
        <!-- Comment Form -->
        <div class="relative mb-6">
          <textarea
            v-model="commentForms[tweet.id]"
            rows="2"
            class="w-full bg-[#001122] border border-[#00FFFF]/20 rounded-lg px-4 py-3 text-white placeholder-[#00FFFF]/30 focus:border-[#FF00FF]/60 focus:ring-2 focus:ring-[#FF00FF]/50 transition-all duration-300 resize-none"
            placeholder="Share your thoughts..."
          ></textarea>
          <div class="absolute right-0 top-0 h-full w-[2px] bg-gradient-to-b from-[#00FFFF]/50 via-[#FF00FF]/50 to-transparent"></div>
          
          <div class="flex justify-end mt-2">
            <button
              @click="submitComment(tweet)"
              :disabled="!commentForms[tweet.id]"
              class="relative px-6 py-2 bg-gradient-to-r from-[#00FFFF] to-[#FF00FF] text-white rounded-lg overflow-hidden transition-all duration-300 hover:scale-105 disabled:opacity-50 disabled:scale-100 disabled:hover:scale-100 group shadow-[0_0_10px_rgba(0,255,255,0.3)] hover:shadow-[0_0_15px_rgba(255,0,255,0.5)]"
            >
              <span class="relative z-10 font-medium tracking-wider">TRANSMIT</span>
              <div class="absolute inset-0 bg-white/20 translate-y-12 group-hover:translate-y-0 transition-transform duration-300"></div>
            </button>
          </div>
        </div>

        <!-- Comments List -->
        <div v-for="comment in tweetStates[tweet.id]?.comments" :key="comment.id" class="flex items-start space-x-3">
          <img :src="comment.user.profile_photo_url" :alt="comment.user.name" class="w-8 h-8 rounded-full border border-[#00FFFF]/30">
          <div class="flex-1">
            <div class="flex items-center space-x-2">
              <span class="text-white text-sm font-medium">{{ comment.user.name }}</span>
              <span class="text-[#00FFFF]/40 text-xs">{{ formatDistanceToNow(new Date(comment.created_at), { addSuffix: true }) }}</span>
            </div>
            <p class="text-white/80 text-sm mt-1">{{ comment.content }}</p>
          </div>
        </div>
      </div>
    </div>

    <!-- Pagination -->
    <div v-if="tweets.links && tweets.links.length > 3" class="mt-6">
      <div class="flex justify-center space-x-2">
        <Link
          v-for="link in tweets.links"
          :key="link.label"
          :href="link.url"
          v-html="link.label"
          class="px-4 py-2 rounded-lg border"
          :class="[
            link.active 
              ? 'bg-[#00FFFF]/10 border-[#00FFFF] text-[#00FFFF]' 
              : 'border-[#00FFFF]/20 text-[#00FFFF]/60 hover:border-[#00FFFF]/40'
          ]"
        />
      </div>
    </div>
  </div>
</template>

<script setup>
import { Link, router } from '@inertiajs/vue3';
import { formatDistanceToNow } from 'date-fns';
import axios from 'axios';
import { ref, reactive, watch } from 'vue';

const props = defineProps({
  tweets: {
    type: Object,
    required: true,
  }
});

// Create a reactive object to store tweet states
const tweetStates = ref({});

// Initialize states for new tweets
watch(() => props.tweets.data, (newTweets) => {
  if (!newTweets) return;
  
  newTweets.forEach(tweet => {
    if (!tweetStates.value[tweet.id]) {
      tweetStates.value[tweet.id] = {
        likes_count: tweet.likes_count,
        comments_count: tweet.comments_count,
        retweets_count: tweet.retweets_count,
        liked: tweet.liked,
        is_retweeted: tweet.is_retweeted
      };
    }
  });
}, { immediate: true });

const like = async (tweet) => {
  try {
    // Optimistic update
    const currentState = !tweetStates.value[tweet.id].liked;
    tweetStates.value[tweet.id].liked = currentState;
    tweetStates.value[tweet.id].likes_count += currentState ? 1 : -1;

    const response = await axios.post(route('tweets.like', tweet.id));
    
    // Update with server response
    tweetStates.value[tweet.id].likes_count = response.data.likes_count;
    tweetStates.value[tweet.id].liked = response.data.liked;
  } catch (error) {
    // Revert optimistic update on error
    tweetStates.value[tweet.id].liked = !tweetStates.value[tweet.id].liked;
    tweetStates.value[tweet.id].likes_count = tweet.likes_count;
    console.error('Error liking tweet:', error);
  }
};

const toggleComments = async (tweet) => {
  if (!tweetStates[tweet.id]?.show_comments) {
    try {
      const response = await axios.get(route('tweets.show', tweet.id));
      tweetStates[tweet.id].comments = response.data.comments;  // Match the response structure
      tweetStates[tweet.id].show_comments = true;
    } catch (error) {
      console.error('Error fetching comments:', error);
    }
  } else {
    tweetStates[tweet.id].show_comments = false;
  }
};

const retweet = async (tweet) => {
  try {
    // Optimistic update
    const currentState = !tweetStates.value[tweet.id].is_retweeted;
    tweetStates.value[tweet.id].is_retweeted = currentState;
    tweetStates.value[tweet.id].retweets_count += currentState ? 1 : -1;

    const response = await axios.post(route('tweets.retweet', tweet.id));
    
    // Update with server response
    tweetStates.value[tweet.id].retweets_count = response.data.retweets_count;
    tweetStates.value[tweet.id].is_retweeted = response.data.is_retweeted;
  } catch (error) {
    // Revert optimistic update on error
    tweetStates.value[tweet.id].is_retweeted = !tweetStates.value[tweet.id].is_retweeted;
    tweetStates.value[tweet.id].retweets_count = tweet.retweets_count;
    console.error('Error retweeting:', error);
  }
};

// Add a reactive object to store comment forms for each tweet
const commentForms = reactive({});

// Add function to submit a comment
const submitComment = async (tweet) => {
  try {
    const response = await axios.post(`/tweets/${tweet.id}/comments`, {
      content: commentForms[tweet.id]
    });
    
    // Add the new comment to the tweet's comments array
    if (!tweetStates[tweet.id].comments) tweetStates[tweet.id].comments = [];
    tweetStates[tweet.id].comments.unshift(response.data.comment);
    tweetStates[tweet.id].comments_count = (tweetStates[tweet.id].comments_count || 0) + 1;
    
    // Clear the comment form
    commentForms[tweet.id] = '';
  } catch (error) {
    console.error('Error posting comment:', error);
    alert('Failed to post comment. Please try again.');
  }
};
</script> 