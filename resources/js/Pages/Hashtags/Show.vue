<template>
  <AppLayout :title="`#${hashtag.name}`">
    <template #header>
      <div class="flex justify-between items-center">
        <h2 class="font-semibold text-xl text-[#00FFFF] leading-tight flex items-center space-x-2">
          <span class="text-[#FF00FF]">#</span>
          <span class="relative">
            {{ hashtag.name }}
            <!-- Glitch Effect -->
            <span class="absolute top-0 left-0 w-full h-full flex items-center justify-center 
              text-[#FF00FF] opacity-50 animate-glitch-1">{{ hashtag.name }}</span>
            <span class="absolute top-0 left-0 w-full h-full flex items-center justify-center 
              text-[#00FFFF] opacity-50 animate-glitch-2">{{ hashtag.name }}</span>
          </span>
        </h2>
        <div class="text-[#00FFFF]/60 text-sm">
          {{ hashtag.tweets_count }} tweets
        </div>
      </div>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Stats Card -->
        <div class="relative mb-8">
          <!-- Neon Border Effect -->
          <div class="absolute -inset-[1px] bg-gradient-to-r from-[#00FFFF] via-[#FF00FF] to-[#00FFFF] rounded-lg opacity-30 blur"></div>
          
          <div class="relative bg-[#001122]/95 backdrop-blur-xl border border-[#00FFFF]/20 rounded-lg p-6">
            <!-- Corner Accents -->
            <div class="absolute top-0 left-0 w-2 h-2 border-l-2 border-t-2 border-[#00FFFF]/50"></div>
            <div class="absolute top-0 right-0 w-2 h-2 border-r-2 border-t-2 border-[#00FFFF]/50"></div>
            <div class="absolute bottom-0 left-0 w-2 h-2 border-l-2 border-b-2 border-[#00FFFF]/50"></div>
            <div class="absolute bottom-0 right-0 w-2 h-2 border-r-2 border-b-2 border-[#00FFFF]/50"></div>

            <div class="grid grid-cols-3 gap-4 text-center">
              <div class="p-4 relative group">
                <div class="text-2xl font-bold text-[#00FFFF] group-hover:text-[#FF00FF] transition-colors">
                  {{ hashtag.tweets_count }}
                </div>
                <div class="text-[#00FFFF]/60 text-sm">Tweets</div>
                <!-- Hover Effect -->
                <div class="absolute inset-0 bg-[#FF00FF]/5 opacity-0 group-hover:opacity-100 transition-opacity rounded-lg"></div>
              </div>
              <div class="p-4 relative group border-x border-[#00FFFF]/10">
                <div class="text-2xl font-bold text-[#00FFFF] group-hover:text-[#FF00FF] transition-colors">
                  {{ hashtag.users_count }}
                </div>
                <div class="text-[#00FFFF]/60 text-sm">Users</div>
                <!-- Hover Effect -->
                <div class="absolute inset-0 bg-[#FF00FF]/5 opacity-0 group-hover:opacity-100 transition-opacity"></div>
              </div>
              <div class="p-4 relative group">
                <div class="text-2xl font-bold text-[#00FFFF] group-hover:text-[#FF00FF] transition-colors">
                  {{ hashtag.likes_count }}
                </div>
                <div class="text-[#00FFFF]/60 text-sm">Likes</div>
                <!-- Hover Effect -->
                <div class="absolute inset-0 bg-[#FF00FF]/5 opacity-0 group-hover:opacity-100 transition-opacity rounded-lg"></div>
              </div>
            </div>
          </div>
        </div>

        <!-- Tweets List -->
        <div v-if="tweets.data.length > 0">
          <TweetList :tweets="tweets" />
        </div>
        <div v-else class="bg-[#001122]/95 backdrop-blur-xl border border-[#00FFFF]/20 rounded-lg p-8 text-center">
          <p class="text-[#00FFFF]/60">No tweets found with this hashtag</p>
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

const props = defineProps({
  hashtag: Object,
  tweets: Object,
});
</script>

<style scoped>
@keyframes glitch-1 {
  0% { clip-path: inset(40% 0 61% 0); transform: translate(-2px); }
  20% { clip-path: inset(92% 0 1% 0); transform: translate(2px); }
  40% { clip-path: inset(43% 0 1% 0); transform: translate(3px); }
  60% { clip-path: inset(25% 0 58% 0); transform: translate(-3px); }
  80% { clip-path: inset(54% 0 7% 0); transform: translate(1px); }
  100% { clip-path: inset(58% 0 43% 0); transform: translate(-2px); }
}

@keyframes glitch-2 {
  0% { clip-path: inset(25% 0 58% 0); transform: translate(2px); }
  20% { clip-path: inset(54% 0 7% 0); transform: translate(-2px); }
  40% { clip-path: inset(58% 0 43% 0); transform: translate(1px); }
  60% { clip-path: inset(40% 0 61% 0); transform: translate(-3px); }
  80% { clip-path: inset(92% 0 1% 0); transform: translate(2px); }
  100% { clip-path: inset(43% 0 1% 0); transform: translate(-1px); }
}

.animate-glitch-1 {
  animation: glitch-1 750ms infinite linear alternate-reverse;
}

.animate-glitch-2 {
  animation: glitch-2 750ms infinite linear alternate-reverse;
}

/* Scanline effect */
.scanline {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 2px;
  background: linear-gradient(to right,
    transparent 0%,
    rgba(0, 255, 255, 0.2) 10%,
    rgba(0, 255, 255, 0.6) 45%,
    rgba(0, 255, 255, 0.6) 55%,
    rgba(0, 255, 255, 0.2) 90%,
    transparent 100%);
  animation: scan 2s linear infinite;
}

@keyframes scan {
  from { transform: translateY(-100%); }
  to { transform: translateY(100vh); }
}
</style> 