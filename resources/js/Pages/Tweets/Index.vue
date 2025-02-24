<template>
  <AppLayout title="Tweets">
    <template #header>
      <div class="flex justify-between items-center">
        <h2 class="font-semibold text-xl text-[#00FFFF] leading-tight">
          Tweets
        </h2>
        <button 
          @click="showTweetForm = true"
          class="bg-[#00FFFF]/10 border border-[#00FFFF]/20 text-[#00FFFF] px-4 py-2 rounded-lg hover:bg-[#00FFFF]/20 transition-all duration-300"
        >
          New Tweet
        </button>
      </div>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Tweet Form Modal -->
        <TweetForm 
          v-if="showTweetForm"
          @close="showTweetForm = false"
          @tweet-created="showTweetForm = false"
        />

        <!-- Tweets List -->
        <div v-if="tweets.data.length > 0">
          <TweetList :tweets="tweets" />
        </div>
        <div v-else class="bg-[#001122]/95 backdrop-blur-xl border border-[#00FFFF]/20 rounded-lg p-8 text-center">
          <p class="text-[#00FFFF]/60">No tweets yet. Be the first to tweet!</p>
        </div>
      </div>
    </div>
  </AppLayout>
</template>

<script setup>
import { ref } from 'vue';
import { Link } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import TweetList from '@/Components/TweetList.vue';
import TweetForm from '@/Components/TweetForm.vue';

const props = defineProps({
  tweets: Object,
  filters: Object,
});

const showTweetForm = ref(false);
</script>

<style scoped>
@keyframes scanline {
  from { transform: translateY(-100%); }
  to { transform: translateY(100%); }
}

.bg-grid-neon {
  background-image: 
    linear-gradient(to right, rgba(0,255,255,0.05) 1px, transparent 1px),
    linear-gradient(to bottom, rgba(0,255,255,0.05) 1px, transparent 1px);
  background-size: 20px 20px;
}

.animate-scanline {
  animation: scanline 8s linear infinite;
}
</style> 