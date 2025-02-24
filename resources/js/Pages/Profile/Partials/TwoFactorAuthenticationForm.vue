<script setup>
import { ref, computed, watch } from 'vue';
import { router, useForm, usePage } from '@inertiajs/vue3';
import ActionSection from '@/Components/ActionSection.vue';
import ConfirmsPassword from '@/Components/ConfirmsPassword.vue';
import DangerButton from '@/Components/DangerButton.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import TextInput from '@/Components/TextInput.vue';

const props = defineProps({
    requiresConfirmation: Boolean,
});

const page = usePage();
const enabling = ref(false);
const confirming = ref(false);
const disabling = ref(false);
const qrCode = ref(null);
const setupKey = ref(null);
const recoveryCodes = ref([]);

const confirmationForm = useForm({
    code: '',
});

const twoFactorEnabled = computed(
    () => ! enabling.value && page.props.auth.user?.two_factor_enabled,
);

watch(twoFactorEnabled, () => {
    if (! twoFactorEnabled.value) {
        confirmationForm.reset();
        confirmationForm.clearErrors();
    }
});

const enableTwoFactorAuthentication = () => {
    enabling.value = true;

    router.post(route('two-factor.enable'), {}, {
        preserveScroll: true,
        onSuccess: () => Promise.all([
            showQrCode(),
            showSetupKey(),
            showRecoveryCodes(),
        ]),
        onFinish: () => {
            enabling.value = false;
            confirming.value = props.requiresConfirmation;
        },
    });
};

const showQrCode = () => {
    return axios.get(route('two-factor.qr-code')).then(response => {
        qrCode.value = response.data.svg;
    });
};

const showSetupKey = () => {
    return axios.get(route('two-factor.secret-key')).then(response => {
        setupKey.value = response.data.secretKey;
    });
}

const showRecoveryCodes = () => {
    return axios.get(route('two-factor.recovery-codes')).then(response => {
        recoveryCodes.value = response.data;
    });
};

const confirmTwoFactorAuthentication = () => {
    confirmationForm.post(route('two-factor.confirm'), {
        errorBag: "confirmTwoFactorAuthentication",
        preserveScroll: true,
        preserveState: true,
        onSuccess: () => {
            confirming.value = false;
            qrCode.value = null;
            setupKey.value = null;
        },
    });
};

const regenerateRecoveryCodes = () => {
    axios
        .post(route('two-factor.recovery-codes'))
        .then(() => showRecoveryCodes());
};

const disableTwoFactorAuthentication = () => {
    disabling.value = true;

    router.delete(route('two-factor.disable'), {
        preserveScroll: true,
        onSuccess: () => {
            disabling.value = false;
            confirming.value = false;
        },
    });
};
</script>

<template>
    <ActionSection>
        <template #title>
            <span class="text-[#00FFFF] font-['Orbitron'] tracking-wider">TWO FACTOR AUTHENTICATION</span>
        </template>

        <template #description>
            <span class="text-[#00FFFF]/70">
                Add additional security to your account using two factor authentication.
            </span>
        </template>

        <template #content>
            <h3 v-if="!enabling && !confirming && !recoveryCodes.length" 
                class="text-lg font-medium text-[#00FFFF]"
            >
                You have not enabled two factor authentication.
            </h3>

            <h3 v-else-if="!enabling && !confirming && recoveryCodes.length" 
                class="text-lg font-medium text-[#00FFFF]"
            >
                You have enabled two factor authentication.
            </h3>

            <h3 v-else 
                class="text-lg font-medium text-[#00FFFF]"
            >
                Finish enabling two factor authentication.
            </h3>

            <div class="mt-3 max-w-xl text-sm text-[#00FFFF]/70">
                <p>
                    When two factor authentication is enabled, you will be prompted for a secure, random token during authentication. You may retrieve this token from your phone's Google Authenticator application.
                </p>
            </div>

            <div v-if="!enabling && !confirming && !recoveryCodes.length">
                <div class="mt-5">
                    <PrimaryButton 
                        type="button" 
                        @click="enableTwoFactorAuthentication"
                        class="bg-[#00FFFF]/10 border border-[#00FFFF]/20 text-[#00FFFF] hover:bg-[#00FFFF]/20"
                    >
                        Enable
                    </PrimaryButton>
                </div>
            </div>

            <div v-if="enabling">
                <div class="mt-4 max-w-xl text-sm text-[#00FFFF]/70">
                    <p class="font-semibold">
                        To finish enabling two factor authentication, scan the following QR code using your phone's authenticator application or enter the setup key and provide the generated OTP code.
                    </p>
                </div>

                <div class="mt-4 p-4 bg-[#001122] border border-[#00FFFF]/20 rounded-lg">
                    <div v-html="qrCode" class="flex justify-center"></div>

                    <div class="mt-4 max-w-xl text-sm text-[#00FFFF]">
                        <p class="font-semibold">
                            Setup Key: <span class="text-[#FF00FF]">{{ setupKey }}</span>
                        </p>
                    </div>
                </div>

                <div class="mt-4">
                    <InputLabel for="code" value="Code" class="text-[#00FFFF]" />

                    <TextInput
                        id="code"
                        v-model="confirmationForm.code"
                        type="text"
                        name="code"
                        class="mt-1 block w-1/2 bg-[#001122] border-[#00FFFF]/20 text-white placeholder-[#00FFFF]/30 focus:border-[#00FFFF] focus:ring focus:ring-[#00FFFF]/20"
                        inputmode="numeric"
                        autofocus
                        autocomplete="one-time-code"
                    />

                    <InputError :message="confirmationForm.errors.code" class="mt-2 text-[#FF00FF]" />
                </div>
            </div>

            <div v-if="!enabling && !confirming && recoveryCodes.length > 0">
                <div class="mt-4 max-w-xl text-sm text-[#00FFFF]/70">
                    <p class="font-semibold">
                        Store these recovery codes in a secure password manager. They can be used to recover access to your account if your two factor authentication device is lost.
                    </p>
                </div>

                <div class="grid gap-1 max-w-xl mt-4 px-4 py-4 font-mono text-sm bg-[#001122] border border-[#00FFFF]/20 rounded-lg">
                    <div v-for="code in recoveryCodes" :key="code" class="text-[#FF00FF]">
                        {{ code }}
                    </div>
                </div>

                <div class="mt-5">
                    <PrimaryButton 
                        @click="regenerateRecoveryCodes"
                        class="bg-[#00FFFF]/10 border border-[#00FFFF]/20 text-[#00FFFF] hover:bg-[#00FFFF]/20"
                    >
                        Regenerate Recovery Codes
                    </PrimaryButton>
                </div>
            </div>
        </template>
    </ActionSection>
</template>

<style scoped>
/* Override QR code colors for better visibility */
:deep(.qr-code) {
    background-color: white !important;
    padding: 1rem;
    border-radius: 0.5rem;
}
</style>
