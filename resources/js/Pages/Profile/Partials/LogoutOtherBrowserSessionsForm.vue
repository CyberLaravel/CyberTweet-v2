<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';
import ActionMessage from '@/Components/ActionMessage.vue';
import ActionSection from '@/Components/ActionSection.vue';
import DialogModal from '@/Components/DialogModal.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import TextInput from '@/Components/TextInput.vue';

defineProps({
    sessions: Array,
});

const confirmingLogout = ref(false);
const passwordInput = ref(null);

const form = useForm({
    password: '',
});

const confirmLogout = () => {
    confirmingLogout.value = true;

    setTimeout(() => passwordInput.value.focus(), 250);
};

const logoutOtherBrowserSessions = () => {
    form.delete(route('other-browser-sessions.destroy'), {
        preserveScroll: true,
        onSuccess: () => closeModal(),
        onError: () => passwordInput.value.focus(),
        onFinish: () => form.reset(),
    });
};

const closeModal = () => {
    confirmingLogout.value = false;

    form.reset();
};
</script>

<template>
    <ActionSection>
        <template #title>
            <span class="text-[#00FFFF] font-['Orbitron'] tracking-wider">BROWSER SESSIONS</span>
        </template>

        <template #description>
            <span class="text-[#00FFFF]/70">Manage and log out your active sessions on other browsers and devices.</span>
        </template>

        <template #content>
            <div class="max-w-xl text-[#00FFFF]/80">
                If necessary, you may log out of all of your other browser sessions across all of your devices. Some of your recent sessions are listed below; however, this list may not be exhaustive. If you feel your account has been compromised, you should also update your password.
            </div>

            <!-- Other Browser Sessions -->
            <div v-if="sessions.length > 0" class="mt-5 space-y-6">
                <div v-for="(session, i) in sessions" :key="i" class="flex items-center">
                    <div>
                        <svg 
                            class="w-8 h-8 text-[#00FFFF]"
                            fill="none"
                            stroke="currentColor"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            viewBox="0 0 24 24"
                        >
                            <!-- SVG path based on device type -->
                        </svg>
                    </div>

                    <div class="ms-3">
                        <div class="text-sm text-[#00FFFF]">
                            {{ session.agent.platform ? session.agent.platform : 'Unknown' }} - {{ session.agent.browser ? session.agent.browser : 'Unknown' }}
                        </div>

                        <div>
                            <div class="text-xs text-[#00FFFF]/70">
                                {{ session.ip_address }},

                                <span v-if="session.is_current_device" class="text-[#FF00FF]">This device</span>
                                <span v-else>Last active {{ session.last_active }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex items-center mt-5">
                <PrimaryButton 
                    class="bg-[#00FFFF]/10 border border-[#00FFFF]/20 text-[#00FFFF] hover:bg-[#00FFFF]/20"
                    @click="confirmLogout"
                >
                    Log Out Other Browser Sessions
                </PrimaryButton>

                <ActionMessage :on="form.recentlySuccessful" class="ms-3 text-[#00FFFF]">
                    Done.
                </ActionMessage>
            </div>

            <!-- Log Out Other Devices Confirmation Modal -->
            <DialogModal :show="confirmingLogout" @close="closeModal">
                <template #title>
                    <span class="text-[#00FFFF] font-['Orbitron']">Log Out Other Browser Sessions</span>
                </template>

                <template #content>
                    <div class="text-[#00FFFF]/80">
                        Please enter your password to confirm you would like to log out of your other browser sessions across all of your devices.
                    </div>

                    <div class="mt-4">
                        <TextInput
                            ref="passwordInput"
                            v-model="form.password"
                            type="password"
                            class="mt-1 block w-3/4 bg-[#001122] border-[#00FFFF]/20 text-white placeholder-[#00FFFF]/30 focus:border-[#00FFFF] focus:ring focus:ring-[#00FFFF]/20"
                            placeholder="Password"
                            @keyup.enter="logoutOtherBrowserSessions"
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

                    <PrimaryButton
                        class="ms-3 bg-[#00FFFF]/10 border border-[#00FFFF]/20 text-[#00FFFF] hover:bg-[#00FFFF]/20"
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                        @click="logoutOtherBrowserSessions"
                    >
                        Log Out Other Browser Sessions
                    </PrimaryButton>
                </template>
            </DialogModal>
        </template>
    </ActionSection>
</template>
