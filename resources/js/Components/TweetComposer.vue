<template>
  <div class="tweet-composer neon-card p-4">
    <form @submit.prevent="submitTweet">
      <textarea 
        v-model="form.content" 
        class="w-full bg-gray-800 text-white p-2 rounded"
        placeholder="What's happening?"
        rows="4"
      ></textarea>
      
      <div class="flex justify-between items-center mt-4">
        <input 
          v-model="hashtagInput" 
          class="w-full bg-gray-800 text-white p-2 rounded mr-2"
          placeholder="Add hashtags (comma separated)"
        />
        
        <button 
          type="submit" 
          class="neon-button px-4 py-2"
          :disabled="!form.content"
        >
          Tweet
        </button>
      </div>
    </form>
  </div>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3'
import { ref, computed } from 'vue'

const hashtagInput = ref('')
const form = useForm({
  content: '',
  hashtags: []
})

const submitTweet = () => {
  // Process hashtags: split by comma, trim, remove duplicates, remove #
  form.hashtags = hashtagInput.value
    .split(',')
    .map(tag => tag.trim().replace(/^#/, ''))
    .filter(tag => tag.length > 0)
    .filter((tag, index, self) => self.indexOf(tag) === index)

  form.post(route('tweets.store'), {
    onSuccess: () => {
      form.reset()
      hashtagInput.value = ''
    }
  })
}
</script> 