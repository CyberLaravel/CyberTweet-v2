<template>
  <div>
    <form @submit.prevent="submit">
      <div class="space-y-4">
        <!-- Tweet Input -->
        <div class="relative">
          <textarea
            v-model="form.content"
            rows="3"
            class="w-full bg-[#001122] border border-[#00FFFF]/20 rounded-lg px-4 py-3 text-white placeholder-[#00FFFF]/30 focus:border-[#00FFFF]/60 focus:ring-1 focus:ring-[#00FFFF]/50 transition-all duration-300 resize-none"
            placeholder="Share your neural transmission..."
          ></textarea>
          <div class="absolute right-0 top-0 h-full w-[2px] bg-gradient-to-b from-[#00FFFF]/50 via-[#FF00FF]/50 to-transparent"></div>
        </div>

        <!-- Error Message -->
        <div v-if="form.errors.content" class="text-sm text-[#FF00FF]">
          {{ form.errors.content }}
        </div>

        <!-- Submit Button -->
        <div class="flex justify-end">
          <button
            type="submit"
            :disabled="form.processing || !form.content"
            class="relative px-6 py-2 bg-gradient-to-r from-[#00FFFF] to-[#FF00FF] text-white rounded-lg overflow-hidden transition-all duration-300 hover:opacity-90 disabled:opacity-50 group"
          >
            <span class="relative z-10">TRANSMIT</span>
            <div class="absolute inset-0 bg-white/20 translate-y-12 group-hover:translate-y-0 transition-transform duration-300"></div>
          </button>
        </div>
      </div>
    </form>
  </div>
</template>

<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';

const form = useForm({
  content: '',
});

const submit = () => {
  form.post(route('tweets.store'), {
    onSuccess: () => form.reset('content'),
  });
};
</script> 