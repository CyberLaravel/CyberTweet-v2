<template>
  <AppLayout>
    <div class="max-w-3xl mx-auto">
      <div class="bg-[#001122]/80 rounded-lg">
        <div class="p-6">
          <h2 class="text-white text-xl mb-6">Edit Tweet</h2>
          
          <textarea
            v-model="form.content"
            placeholder="What's happening?"
            class="w-full bg-transparent text-white placeholder-gray-500 text-base resize-none focus:outline-none"
            rows="4"
          ></textarea>

          <div class="mt-4 border-t border-[#00FFFF]/10 pt-4">
            <input
              v-model="hashtagInput"
              type="text"
              placeholder="Add hashtags (comma separated)"
              class="w-full bg-transparent text-white placeholder-gray-500 text-base focus:outline-none"
            />
          </div>

          <div class="flex justify-end mt-4 space-x-4">
            <Link
              :href="route('tweets.index')"
              class="px-8 py-2 rounded-lg border border-gray-600 text-gray-400 text-sm
                     hover:text-white hover:border-white transition-all duration-300"
            >
              Cancel
            </Link>
            <button 
              @click="submit"
              :disabled="form.processing"
              class="px-8 py-2 rounded-lg bg-[#00FFFF] text-[#001122] font-medium text-sm
                     hover:bg-[#00FFFF]/90 transition-all duration-300 disabled:opacity-50"
            >
              {{ form.processing ? 'Saving...' : 'Save Changes' }}
            </button>
          </div>
        </div>
      </div>
    </div>
  </AppLayout>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3'
import { ref, onMounted } from 'vue'
import AppLayout from '@/Layouts/AppLayout.vue'
import { Link } from '@inertiajs/vue3'

const props = defineProps({
  tweet: Object
})

const hashtagInput = ref('')

const form = useForm({
  content: props.tweet.content,
  hashtags: []
})

onMounted(() => {
  // Set initial hashtags
  hashtagInput.value = props.tweet.hashtags.map(tag => tag.name).join(', ')
})

const submit = () => {
  const hashtagArray = hashtagInput.value
    .split(',')
    .map(tag => tag.trim().toLowerCase().replace(/[^a-z0-9]/g, ''))
    .filter(tag => tag.length > 0)

  form.put(route('tweets.update', props.tweet.id), {
    preserveScroll: true,
    preserveState: false,
    data: {
      content: form.content,
      hashtags: hashtagArray
    },
    onSuccess: () => {
      form.reset()
      hashtagInput.value = ''
    },
    onError: (errors) => {
      console.error('Validation errors:', errors)
    }
  })
}
</script> 