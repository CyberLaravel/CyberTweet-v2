<script setup>
import Modal from '@/Components/Modal.vue';

const emit = defineEmits(['close']);

defineProps({
    show: {
        type: Boolean,
        default: false,
    },
    maxWidth: {
        type: String,
        default: '2xl',
    },
    closeable: {
        type: Boolean,
        default: true,
    },
});

const close = () => {
    emit('close');
};
</script>

<template>
    <Modal
        :show="show"
        :max-width="maxWidth"
        :closeable="closeable"
        @close="close"
    >
        <div class="bg-[#001122]/95 backdrop-blur-xl border border-[#00FFFF]/20 px-6 py-4 rounded-t-lg">
            <div class="text-lg font-medium">
                <slot name="title" />
            </div>
        </div>

        <div class="bg-[#001122]/95 backdrop-blur-xl border-t border-b border-[#00FFFF]/20 px-6 py-4">
            <slot name="content" />
        </div>

        <div class="bg-[#001122]/95 backdrop-blur-xl border border-[#00FFFF]/20 px-6 py-4 rounded-b-lg text-right">
            <slot name="footer" />
        </div>
    </Modal>
</template>
