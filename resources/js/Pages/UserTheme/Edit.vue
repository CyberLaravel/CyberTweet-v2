<template>
  <AppLayout>
    <div class="theme-editor neon-container">
      <h1 class="neon-text text-3xl mb-6">Customize Your Theme</h1>
      
      <form @submit.prevent="updateTheme" class="theme-form">
        <div class="color-picker">
          <label class="text-neon-blue">Primary Color</label>
          <input 
            type="color" 
            v-model="form.primary_color" 
            class="neon-input"
          />
        </div>
        
        <div class="color-picker">
          <label class="text-neon-blue">Secondary Color</label>
          <input 
            type="color" 
            v-model="form.secondary_color" 
            class="neon-input"
          />
        </div>
        
        <button type="submit" class="neon-button mt-4">
          Update Theme
        </button>
      </form>
    </div>
  </AppLayout>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3'
import AppLayout from '@/Layouts/AppLayout.vue'

const form = useForm({
  primary_color: props.theme.primary_color || '#00ff00',
  secondary_color: props.theme.secondary_color || '#ff00ff'
})

const updateTheme = () => {
  form.put(route('user-theme.update'))
}

const props = defineProps({
  theme: Object
})
</script> 