<template>
  <AppLayout>
    <div class="achievements-container neon-container">
      <h1 class="neon-text text-3xl mb-6">Achievements</h1>
      
      <div v-if="achievements.length" class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div 
          v-for="achievement in achievements" 
          :key="achievement.id" 
          class="achievement-card neon-card"
        >
          <h2 class="text-xl font-bold text-neon-blue">{{ achievement.name }}</h2>
          <p class="text-neon-purple">{{ achievement.description }}</p>
          <Link 
            :href="route('achievements.show', achievement.id)" 
            class="neon-button mt-4"
          >
            View Details
          </Link>
        </div>
      </div>
      
      <div v-else class="text-center neon-text">
        No achievements available
      </div>
    </div>
  </AppLayout>
</template>

<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import { Link } from '@inertiajs/vue3'

defineProps({
  achievements: Array
})
</script>

