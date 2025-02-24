<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    href: String,
    active: Boolean,
    as: String,
});

const classes = computed(() => {
    return props.active
        ? 'block w-full pl-3 pr-4 py-2 border-l-4 border-[#00FFFF] text-left text-base font-medium text-[#00FFFF] bg-[#00FFFF]/10 focus:outline-none focus:text-[#00FFFF] focus:bg-[#00FFFF]/10 focus:border-[#00FFFF] transition duration-150 ease-in-out'
        : 'block w-full pl-3 pr-4 py-2 border-l-4 border-transparent text-left text-base font-medium text-[#00FFFF]/60 hover:text-[#00FFFF] hover:bg-[#00FFFF]/10 hover:border-[#00FFFF]/40 focus:outline-none focus:text-[#00FFFF] focus:bg-[#00FFFF]/10 focus:border-[#00FFFF]/40 transition duration-150 ease-in-out'
});
</script>

<template>
    <div>
        <button v-if="as == 'button'" :class="classes" class="w-full text-left">
            <slot />
        </button>

        <Link v-else :href="href" :class="classes">
            <slot />
        </Link>
    </div>
</template>
