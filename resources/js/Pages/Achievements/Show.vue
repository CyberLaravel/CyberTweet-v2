<template>
  <AppLayout>
    <div class="achievement-detail neon-container">
      <h1 class="neon-text text-3xl mb-6">{{ achievement.name }}</h1>
      
      <div class="achievement-info neon-card">
        <p class="text-neon-purple">{{ achievement.description }}</p>
        
        <div class="users-with-achievement mt-4">
          <h2 class="text-xl text-neon-blue">Users who earned this achievement:</h2>
          <ul v-if="achievement.users.length" class="list-disc pl-5">
            <li 
              v-for="user in achievement.users" 
              :key="user.id" 
              class="text-neon-green"
            >
              {{ user.name }}
            </li>
          </ul>
          <p v-else class="text-neon-red">No users have earned this achievement yet</p>
        </div>
      </div>
    </div>
  </AppLayout>
</template>

<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'

defineProps({
  achievement: Object
})
</script> 