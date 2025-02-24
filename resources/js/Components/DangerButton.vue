<script setup>
defineProps({
    type: {
        type: String,
        default: 'button',
    },
});
</script>

<template>
    <button
        :type="type"
        class="inline-flex items-center px-4 py-2 bg-[#FF00FF]/10 border border-[#FF00FF]/20 rounded-md font-semibold text-xs text-[#FF00FF] uppercase tracking-widest hover:bg-[#FF00FF]/20 focus:outline-none focus:ring-2 focus:ring-[#FF00FF] focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150"
    >
        <slot />
    </button>
</template>
