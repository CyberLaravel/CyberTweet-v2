<script setup>
import { ref } from 'vue';
import { router } from '@inertiajs/vue3';
import Modal from '@/Components/Modal.vue';
import TextInput from '@/Components/TextInput.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';

const props = defineProps({
    show: {
        type: Boolean,
        default: true
    }
});

const emit = defineEmits(['close', 'tweet-created']);

const form = ref({
    content: '',
    processing: false
});

const submit = () => {
    form.value.processing = true;
    router.post(route('tweets.store'), {
        content: form.value.content
    }, {
        onSuccess: () => {
            form.value.content = '';
            emit('tweet-created');
        },
        onFinish: () => {
            form.value.processing = false;
        }
    });
};
</script>

<template>
    <Modal :show="show" @close="$emit('close')">
        <div class="p-6">
            <h2 class="text-lg font-medium text-[#00FFFF] mb-4">
                Create New Tweet
            </h2>

            <form @submit.prevent="submit">
                <div class="mb-4">
                    <textarea
                        v-model="form.content"
                        class="w-full bg-[#001122] border border-[#00FFFF]/20 rounded-lg px-4 py-3 text-white placeholder-[#00FFFF]/30 focus:border-[#00FFFF] focus:ring focus:ring-[#00FFFF]/20"
                        rows="3"
                        placeholder="What's happening?"
                        maxlength="280"
                    ></textarea>
                </div>

                <div class="flex justify-end space-x-3">
                    <SecondaryButton @click="$emit('close')">
                        Cancel
                    </SecondaryButton>
                    <PrimaryButton
                        :disabled="!form.content || form.processing"
                        :class="{ 'opacity-25': form.processing }"
                    >
                        Tweet
                    </PrimaryButton>
                </div>
            </form>
        </div>
    </Modal>
</template> 