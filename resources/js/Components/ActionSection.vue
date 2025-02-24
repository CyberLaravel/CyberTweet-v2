<script setup>
import SectionTitle from '@/Components/SectionTitle.vue';
</script>

<template>
    <div class="md:grid md:grid-cols-3 md:gap-6">
        <SectionTitle>
            <template #title><slot name="title" /></template>
            <template #description><slot name="description" /></template>
        </SectionTitle>

        <div class="mt-5 md:mt-0 md:col-span-2">
            <div class="px-4 py-5 sm:p-6 bg-[#001122]/95 backdrop-blur-xl border border-[#00FFFF]/20 shadow-[0_0_50px_rgba(0,255,255,0.1)] rounded-lg">
                <slot name="content" />
            </div>
        </div>
    </div>
</template>
