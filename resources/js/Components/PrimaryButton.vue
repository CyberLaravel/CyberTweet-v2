<script setup>
defineProps({
    primary: Boolean,
    danger: Boolean,
});
</script>

<template>
    <button
        class="inline-flex items-center px-4 py-2 border rounded-md font-semibold text-xs uppercase tracking-widest transition ease-in-out duration-150 focus:outline-none disabled:opacity-25"
        :class="[
            primary ? 'bg-[#00FFFF]/10 border-[#00FFFF]/20 text-[#00FFFF] hover:bg-[#00FFFF]/20' :
            danger ? 'bg-[#FF00FF]/10 border-[#FF00FF]/20 text-[#FF00FF] hover:bg-[#FF00FF]/20' :
            'bg-[#001122] border-[#00FFFF]/20 text-[#00FFFF] hover:bg-[#00FFFF]/10'
        ]"
    >
        <slot />
    </button>
</template>
