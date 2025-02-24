<template>
  <div class="flex space-x-3 p-4 border-t border-[#00FFFF]/10">
    <img 
      :src="comment.user.profile_photo_url" 
      :alt="comment.user.name"
      class="w-8 h-8 rounded-full"
    />
    <div class="flex-1">
      <div class="flex items-center">
        <span class="text-white text-sm font-medium">{{ comment.user.name }}</span>
        <span class="text-gray-500 text-xs ml-2">@{{ comment.user.username }}</span>
        <span class="text-gray-500 text-xs ml-2">{{ comment.created_at }}</span>
      </div>
      <p class="text-white text-sm mt-1">{{ comment.content }}</p>
      
      <!-- Delete button (only for comment owner) -->
      <button 
        v-if="comment.user.id === $page.props.auth.user?.id"
        @click="$emit('delete', comment)"
        class="text-gray-500 text-xs hover:text-[#FF00FF] transition-colors duration-300 mt-2"
      >
        Delete
      </button>
    </div>
  </div>
</template>

<script setup>
defineProps({
  comment: {
    type: Object,
    required: true
  }
})

defineEmits(['delete'])
</script> 