<template>
  <AppLayout>
    <div class="notifications-container neon-container">
      <h1 class="neon-text text-3xl mb-6">Notifications</h1>
      
      <div 
        v-for="notification in notifications.data" 
        :key="notification.id" 
        class="notification-card neon-card mb-4"
      >
        <div class="flex items-center">
          <img 
            :src="notification.actor.profile_photo_url" 
            class="w-10 h-10 rounded-full mr-4"
          />
          <div>
            <p class="text-neon-green">{{ notification.message }}</p>
            <small class="text-neon-purple">
              {{ formatDistance(notification.created_at) }}
            </small>
          </div>
        </div>
      </div>
      
      <Pagination 
        :links="notifications.links" 
        class="mt-4"
      />
    </div>
  </AppLayout>
</template>

<script setup>
import { formatDistance } from '@/Utils/dateHelpers'
import AppLayout from '@/Layouts/AppLayout.vue'
import Pagination from '@/Components/Pagination.vue'

defineProps({
  notifications: Object
})
</script> 