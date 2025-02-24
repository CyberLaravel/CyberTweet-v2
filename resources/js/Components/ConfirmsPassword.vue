<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';
import DialogModal from '@/Components/DialogModal.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import TextInput from '@/Components/TextInput.vue';

const emit = defineEmits(['confirmed']);

const props = defineProps({
    title: {
        type: String,
        default: 'Confirm Password',
    },
    content: {
        type: String,
        default: 'For your security, please confirm your password to continue.',
    },
    button: {
        type: String,
        default: 'Confirm',
    },
});

const confirmingPassword = ref(false);
const form = useForm({
    password: '',
});
const passwordInput = ref(null);

const startConfirmingPassword = () => {
    confirmingPassword.value = true;

    setTimeout(() => passwordInput.value?.focus(), 250);
};

const confirmPassword = () => {
    form.post(route('password.confirm'), {
        preserveScroll: true,
        onSuccess: () => {
            confirmingPassword.value = false;
            form.reset();
            emit('confirmed');
        },
        onError: () => {
            passwordInput.value?.focus();
        },
    });
};
</script>

<template>
    <span>
        <span @click="startConfirmingPassword">
            <slot />
        </span>

        <DialogModal :show="confirmingPassword" @close="confirmingPassword = false">
            <template #title>
                <span class="text-[#00FFFF] font-['Orbitron']">{{ title }}</span>
            </template>

            <template #content>
                <div class="text-[#00FFFF]/70">
                    {{ content }}
                </div>

                <div class="mt-4">
                    <TextInput
                        ref="passwordInput"
                        v-model="form.password"
                        type="password"
                        class="mt-1 block w-3/4"
                        placeholder="Password"
                        autocomplete="current-password"
                        @keyup.enter="confirmPassword"
                    />

                    <InputError :message="form.errors.password" class="mt-2" />
                </div>
            </template>

            <template #footer>
                <SecondaryButton @click="confirmingPassword = false">
                    Cancel
                </SecondaryButton>

                <PrimaryButton
                    class="ms-3"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                    @click="confirmPassword"
                >
                    {{ button }}
                </PrimaryButton>
            </template>
        </DialogModal>
    </span>
</template>
