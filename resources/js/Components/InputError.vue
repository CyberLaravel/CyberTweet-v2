<script setup>
defineProps(['message']);
</script>

<template>
    <div v-show="message">
        <p class="text-sm text-[#FF00FF]">
            {{ message }}
        </p>
    </div>
</template>
