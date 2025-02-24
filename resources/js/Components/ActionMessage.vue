<script setup>
defineProps({
    on: Boolean,
});
</script>

<template>
    <div v-show="on" class="text-sm">
        <div class="inline-flex items-center px-3 py-1 border border-[#00FFFF]/20 rounded-md bg-[#00FFFF]/5 backdrop-blur">
            <div class="flex items-center space-x-2">
                <svg class="w-4 h-4 text-[#00FFFF]" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                </svg>
                <span><slot /></span>
            </div>
        </div>
    </div>
</template>
