<template>
  <AppLayout title="Hashtags">
    <template #header>
      <div class="flex justify-between items-center">
        <h2 class="font-semibold text-xl text-[#00FFFF] leading-tight">
          Hashtags
        </h2>
        <!-- Search Input -->
        <div class="relative">
          <input
            v-model="searchQuery"
            type="text"
            placeholder="Search hashtags..."
            class="bg-[#001122]/80 border border-[#00FFFF]/20 rounded-lg px-4 py-2 text-[#00FFFF] 
              placeholder-[#00FFFF]/30 focus:border-[#FF00FF] focus:ring focus:ring-[#FF00FF]/20
              w-64 transition-all duration-300"
          >
          <div class="absolute right-0 top-0 h-full w-[2px] bg-gradient-to-b from-[#00FFFF]/50 via-[#FF00FF]/50 to-transparent"></div>
        </div>
      </div>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Trending Section -->
        <div class="relative mb-8">
          <!-- Neon Border Effect -->
          <div class="absolute -inset-[1px] bg-gradient-to-r from-[#00FFFF] via-[#FF00FF] to-[#00FFFF] rounded-lg opacity-30 blur"></div>
          
          <div class="relative bg-[#001122]/95 backdrop-blur-xl border border-[#00FFFF]/20 rounded-lg p-6">
            <!-- Corner Accents -->
            <div class="absolute top-0 left-0 w-2 h-2 border-l-2 border-t-2 border-[#00FFFF]/50"></div>
            <div class="absolute top-0 right-0 w-2 h-2 border-r-2 border-t-2 border-[#00FFFF]/50"></div>
            <div class="absolute bottom-0 left-0 w-2 h-2 border-l-2 border-b-2 border-[#00FFFF]/50"></div>
            <div class="absolute bottom-0 right-0 w-2 h-2 border-r-2 border-b-2 border-[#00FFFF]/50"></div>

            <h3 class="text-[#FF00FF] text-lg font-semibold mb-4 flex items-center">
              <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                <path d="M17.8 13.75l-7.5-13A.5.5 0 0 0 9.8.5h-.1a.5.5 0 0 0-.4.25l-7.5 13a.5.5 0 0 0 0 .5.5.5 0 0 0 .4.25h15a.5.5 0 0 0 .4-.25.5.5 0 0 0 0-.5z"/>
              </svg>
              Trending
            </h3>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
              <Link
                v-for="hashtag in trending"
                :key="hashtag.id"
                :href="route('hashtags.show', { hashtag: hashtag.name })"
                class="group relative overflow-hidden rounded-lg p-4 bg-[#001122]/50 border border-[#00FFFF]/10
                  hover:border-[#FF00FF]/30 transition-all duration-300"
              >
                <div class="flex items-center space-x-2">
                  <span class="text-[#FF00FF] font-bold">#</span>
                  <span class="text-[#00FFFF] group-hover:text-[#FF00FF] transition-colors">
                    {{ hashtag.name }}
                  </span>
                </div>
                <div class="text-[#00FFFF]/60 text-sm mt-2">
                  {{ hashtag.tweets_count }} tweets
                </div>
                <!-- Hover Effect -->
                <div class="absolute inset-0 bg-[#FF00FF]/5 opacity-0 group-hover:opacity-100 transition-opacity"></div>
              </Link>
            </div>
          </div>
        </div>

        <!-- All Hashtags Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
          <Link
            v-for="hashtag in filteredHashtags"
            :key="hashtag.id"
            :href="route('hashtags.show', { hashtag: hashtag.name })"
            class="relative group"
          >
            <!-- Neon Border Effect -->
            <div class="absolute -inset-[1px] bg-gradient-to-r from-[#00FFFF] via-[#FF00FF] to-[#00FFFF] rounded-lg opacity-30 blur group-hover:opacity-50 transition-opacity"></div>
            
            <div class="relative bg-[#001122]/95 backdrop-blur-xl border border-[#00FFFF]/20 rounded-lg p-6
              hover:border-[#FF00FF]/30 transition-all duration-300">
              <!-- Corner Accents -->
              <div class="absolute top-0 left-0 w-2 h-2 border-l-2 border-t-2 border-[#00FFFF]/50"></div>
              <div class="absolute top-0 right-0 w-2 h-2 border-r-2 border-t-2 border-[#00FFFF]/50"></div>
              <div class="absolute bottom-0 left-0 w-2 h-2 border-l-2 border-b-2 border-[#00FFFF]/50"></div>
              <div class="absolute bottom-0 right-0 w-2 h-2 border-r-2 border-b-2 border-[#00FFFF]/50"></div>

              <div class="flex items-center space-x-2 mb-4">
                <span class="text-[#FF00FF] text-xl font-bold">#</span>
                <span class="text-[#00FFFF] text-xl group-hover:text-[#FF00FF] transition-colors">
                  {{ hashtag.name }}
                </span>
              </div>

              <div class="grid grid-cols-2 gap-4 text-center">
                <div class="p-2">
                  <div class="text-lg font-bold text-[#00FFFF] group-hover:text-[#FF00FF] transition-colors">
                    {{ hashtag.tweets_count }}
                  </div>
                  <div class="text-[#00FFFF]/60 text-sm">Tweets</div>
                </div>
                <div class="p-2 border-l border-[#00FFFF]/10">
                  <div class="text-lg font-bold text-[#00FFFF] group-hover:text-[#FF00FF] transition-colors">
                    {{ hashtag.users_count }}
                  </div>
                  <div class="text-[#00FFFF]/60 text-sm">Users</div>
                </div>
              </div>
            </div>
          </Link>
        </div>

        <!-- Pagination -->
        <div v-if="hashtags.links && hashtags.links.length > 3" class="mt-6">
          <div class="flex justify-center space-x-2">
            <Link
              v-for="link in hashtags.links"
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
    </div>
  </AppLayout>
</template>

<script setup>
import { ref, computed } from 'vue';
import { Link } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';

const props = defineProps({
  hashtags: Object,
  trending: Array,
});

const searchQuery = ref('');
const filteredHashtags = computed(() => {
  if (!searchQuery.value) return props.hashtags.data;
  return props.hashtags.data.filter(hashtag => 
    hashtag.name.toLowerCase().includes(searchQuery.value.toLowerCase())
  );
});
</script>

<style scoped>
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