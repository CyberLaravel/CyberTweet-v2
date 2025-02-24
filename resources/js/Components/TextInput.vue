<script setup>
import { onMounted, ref } from 'vue';

defineProps(['modelValue']);
defineEmits(['update:modelValue']);

const input = ref(null);

onMounted(() => {
    if (input.value.hasAttribute('autofocus')) {
        input.value.focus();
    }
});

defineExpose({ focus: () => input.value.focus() });
</script>

<template>
    <input
        ref="input"
        class="border-[#00FFFF]/20 bg-[#001122] text-white placeholder-[#00FFFF]/30 focus:border-[#00FFFF] focus:ring focus:ring-[#00FFFF]/20 rounded-md shadow-sm"
        :value="modelValue"
        @input="$emit('update:modelValue', $event.target.value)"
    >
</template>
