<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';
import ActionSection from '@/Components/ActionSection.vue';
import DangerButton from '@/Components/DangerButton.vue';
import DialogModal from '@/Components/DialogModal.vue';
import InputError from '@/Components/InputError.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import TextInput from '@/Components/TextInput.vue';

const confirmingUserDeletion = ref(false);
const passwordInput = ref(null);

const form = useForm({
    password: '',
});

const confirmUserDeletion = () => {
    confirmingUserDeletion.value = true;

    setTimeout(() => passwordInput.value.focus(), 250);
};

const deleteUser = () => {
    form.delete(route('current-user.destroy'), {
        preserveScroll: true,
        onSuccess: () => closeModal(),
        onError: () => passwordInput.value.focus(),
        onFinish: () => form.reset(),
    });
};

const closeModal = () => {
    confirmingUserDeletion.value = false;

    form.reset();
};
</script>

<template>
    <ActionSection>
        <template #title>
            <span class="text-[#FF00FF] font-['Orbitron'] tracking-wider">DELETE ACCOUNT</span>
        </template>

        <template #description>
            <span class="text-[#FF00FF]/70">Permanently delete your account.</span>
        </template>

        <template #content>
            <div class="max-w-xl text-[#00FFFF]/80">
                Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.
            </div>

            <div class="mt-5">
                <DangerButton 
                    class="bg-[#FF00FF]/10 border border-[#FF00FF]/20 text-[#FF00FF] hover:bg-[#FF00FF]/20"
                    @click="confirmUserDeletion"
                >
                    Delete Account
                </DangerButton>
            </div>

            <!-- Delete Account Confirmation Modal -->
            <DialogModal :show="confirmingUserDeletion" @close="closeModal">
                <template #title>
                    <span class="text-[#FF00FF] font-['Orbitron']">Delete Account?</span>
                </template>

                <template #content>
                    <div class="text-[#00FFFF]/80">
                        Are you sure you want to delete your account? Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.
                    </div>

                    <div class="mt-4">
                        <TextInput
                            ref="passwordInput"
                            v-model="form.password"
                            type="password"
                            class="mt-1 block w-3/4 bg-[#001122] border-[#00FFFF]/20 text-white placeholder-[#00FFFF]/30 focus:border-[#00FFFF] focus:ring focus:ring-[#00FFFF]/20"
                            placeholder="Password"
                            @keyup.enter="deleteUser"
                        />

                        <InputError :message="form.errors.password" class="mt-2 text-[#FF00FF]" />
                    </div>
                </template>

                <template #footer>
                    <SecondaryButton 
                        class="bg-[#001122] text-[#00FFFF] border-[#00FFFF]/20 hover:bg-[#00FFFF]/10"
                        @click="closeModal"
                    >
                        Cancel
                    </SecondaryButton>

                    <DangerButton
                        class="ms-3 bg-[#FF00FF]/10 border border-[#FF00FF]/20 text-[#FF00FF] hover:bg-[#FF00FF]/20"
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                        @click="deleteUser"
                    >
                        Delete Account
                    </DangerButton>
                </template>
            </DialogModal>
        </template>
    </ActionSection>
</template>
