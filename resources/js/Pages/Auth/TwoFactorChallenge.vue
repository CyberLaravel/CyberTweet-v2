<script setup>
import { nextTick, ref } from 'vue';
import { Head, useForm } from '@inertiajs/vue3';

const recovery = ref(false);

const form = useForm({
    code: '',
    recovery_code: '',
});

const recoveryCodeInput = ref(null);
const codeInput = ref(null);

const toggleRecovery = async () => {
    recovery.value ^= true;

    await nextTick();

    if (recovery.value) {
        recoveryCodeInput.value.focus();
        form.code = '';
    } else {
        codeInput.value.focus();
        form.recovery_code = '';
    }
};

const submit = () => {
    form.post(route('two-factor.login'));
};
</script>

<template>
    <Head title="Two-factor Confirmation" />

    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-black relative overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-br from-black to-gray-900 opacity-90 pointer-events-none"></div>
        <div class="absolute inset-0 bg-[length:50px_50px] opacity-10 bg-[linear-gradient(90deg,rgba(0,255,255,0.1)_1px,transparent_1px),linear-gradient(rgba(0,255,255,0.1)_1px,transparent_1px)] pointer-events-none"></div>

        <div class="w-full sm:max-w-md mt-6 px-6 py-8 bg-black/80 border border-cyan-500/30 shadow-2xl shadow-cyan-500/20 relative z-10">
            <div class="text-center mb-8">
                <h1 class="text-4xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-cyan-500 to-pink-500 animate-pulse">
                    CYBER<span class="text-pink-500">TWEET</span>
                </h1>
            </div>

            <div class="mb-4 text-sm text-cyan-500">
                <template v-if="!recovery">
                    Please confirm access to your account by entering the authentication code provided by your authenticator application.
                </template>
                <template v-else>
                    Please confirm access to your account by entering one of your emergency recovery codes.
                </template>
            </div>

            <form @submit.prevent="submit" class="space-y-6">
                <div v-if="!recovery">
                    <label 
                        htmlFor="code" 
                        class="block text-sm font-bold text-cyan-500 mb-2"
                    >
                        AUTHENTICATION CODE
                    </label>
                    <input 
                        id="code"
                        ref="codeInput"
                        type="text" 
                        v-model="form.code"
                        inputmode="numeric"
                        autofocus
                        autocomplete="one-time-code"
                        class="w-full px-3 py-2 bg-black/50 border border-cyan-500/50 text-cyan-500 
                               focus:outline-none focus:border-pink-500 focus:ring-1 focus:ring-pink-500 
                               placeholder-cyan-500/50 transition duration-300"
                    />
                    <p 
                        v-if="form.errors.code" 
                        class="text-red-500 text-xs mt-1"
                    >
                        {{ form.errors.code }}
                    </p>
                </div>

                <div v-else>
                    <label 
                        htmlFor="recovery_code" 
                        class="block text-sm font-bold text-cyan-500 mb-2"
                    >
                        RECOVERY CODE
                    </label>
                    <input 
                        id="recovery_code"
                        ref="recoveryCodeInput"
                        type="text" 
                        v-model="form.recovery_code"
                        autocomplete="one-time-code"
                        class="w-full px-3 py-2 bg-black/50 border border-cyan-500/50 text-cyan-500 
                               focus:outline-none focus:border-pink-500 focus:ring-1 focus:ring-pink-500 
                               placeholder-cyan-500/50 transition duration-300"
                    />
                    <p 
                        v-if="form.errors.recovery_code" 
                        class="text-red-500 text-xs mt-1"
                    >
                        {{ form.errors.recovery_code }}
                    </p>
                </div>

                <div class="flex items-center justify-between">
                    <button 
                        type="button" 
                        @click.prevent="toggleRecovery"
                        class="text-sm text-cyan-500 hover:text-pink-500 transition duration-300"
                    >
                        <template v-if="!recovery">
                            Use a recovery code
                        </template>
                        <template v-else>
                            Use an authentication code
                        </template>
                    </button>

                    <button 
                        type="submit" 
                        :disabled="form.processing"
                        class="px-4 py-2 bg-gradient-to-r from-cyan-500 to-pink-500 
                               text-black font-bold uppercase 
                               hover:from-cyan-600 hover:to-pink-600 
                               focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:ring-offset-2 
                               transition duration-300 
                               disabled:opacity-50"
                    >
                        Log in
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>
