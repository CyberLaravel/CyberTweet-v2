<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    href: String,
    active: Boolean
});

const classes = computed(() => {
    return props.active
        ? 'inline-flex items-center px-1 pt-1 border-b-2 border-[#00FFFF] text-sm font-medium leading-5 text-[#00FFFF] focus:outline-none focus:border-[#FF00FF] transition duration-150 ease-in-out'
        : 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-[#00FFFF]/60 hover:text-[#00FFFF] hover:border-[#00FFFF]/40 focus:outline-none focus:text-[#00FFFF] focus:border-[#00FFFF]/40 transition duration-150 ease-in-out'
});
</script>

<template>
    <Link :href="href" :class="classes">
        <slot />
    </Link>
</template>
