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
        class="inline-flex items-center px-4 py-2 bg-[#001122] border border-[#00FFFF]/20 rounded-md font-semibold text-xs text-[#00FFFF] uppercase tracking-widest shadow-sm hover:bg-[#00FFFF]/10 focus:outline-none focus:ring-2 focus:ring-[#00FFFF] focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150"
    >
        <slot />
    </button>
</template>
