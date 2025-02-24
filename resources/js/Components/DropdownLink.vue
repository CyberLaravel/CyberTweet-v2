<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({
    href: String,
    as: String,
});
</script>

<template>
    <div>
        <button v-if="as == 'button'"
            type="submit"
            class="block w-full px-4 py-2 text-left text-sm leading-5 text-[#00FFFF] hover:bg-[#00FFFF]/10 focus:outline-none focus:bg-[#00FFFF]/10 transition duration-150 ease-in-out"
        >
            <slot />
        </button>

        <Link v-else-if="as == 'a'"
            :href="href"
            class="block px-4 py-2 text-sm leading-5 text-[#00FFFF] hover:bg-[#00FFFF]/10 focus:outline-none focus:bg-[#00FFFF]/10 transition duration-150 ease-in-out"
        >
            <slot />
        </Link>

        <Link v-else
            :href="href"
            class="block px-4 py-2 text-sm leading-5 text-[#00FFFF] hover:bg-[#00FFFF]/10 focus:outline-none focus:bg-[#00FFFF]/10 transition duration-150 ease-in-out"
        >
            <slot />
        </Link>
    </div>
</template>
