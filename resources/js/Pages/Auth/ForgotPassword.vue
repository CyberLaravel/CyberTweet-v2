<script setup>
import { ref, computed } from 'vue';
import { Head, useForm, Link } from '@inertiajs/vue3';

const form = useForm({
    email: '',
});

const isHovered = ref(false);
const isSubmitting = ref(false);

const isValidEmail = computed(() => {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(form.email);
});

const submit = () => {
    if (isValidEmail.value) {
        isSubmitting.value = true;
        form.post(route('password.email'), {
            onFinish: () => {
                isSubmitting.value = false;
            },
            onError: () => {
                console.error('Password recovery failed');
            }
        });
    }
};
</script>

<template>
    <Head title="CyberTweet Recovery" />

    <div class="min-h-screen flex items-center justify-center bg-black overflow-hidden relative">
        <!-- Matrix Background Effect -->
        <div class="absolute inset-0 pointer-events-none bg-gradient-to-br from-black/90 via-black/70 to-black/90 
                    before:absolute before:inset-0 before:bg-grid-cyan/5 
                    after:absolute after:inset-0 after:bg-radial-cyan/10"></div>

        <!-- Quantum Core Glow -->
        <div class="absolute -top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 
                    w-[150vh] h-[150vh] 
                    bg-gradient-radial from-cyan-500/10 via-pink-500/10 to-transparent 
                    blur-[100px] animate-quantum-pulse"></div>

        <!-- Main Container -->
        <div class="relative z-10 w-full max-w-md p-8 
                    bg-black/80 
                    border-2 border-cyan-500/30 
                    backdrop-blur-xl 
                    rounded-xl 
                    shadow-2xl 
                    hover:scale-[1.01] 
                    transition-transform 
                    duration-500">

            <!-- Header -->
            <div class="text-center mb-8">
                <h1 class="text-4xl font-bold uppercase 
                           bg-gradient-to-r from-cyan-400 to-pink-500 
                           bg-clip-text text-transparent 
                           tracking-wider
                           drop-shadow-[0_0_10px_rgba(0,255,255,0.3)]">
                    CYBERTWEET RECOVERY
                </h1>
                <p class="text-xs text-cyan-300 mt-2 
                          font-mono 
                          tracking-[0.3em] 
                          uppercase 
                          opacity-80
                          drop-shadow-[0_0_5px_rgba(0,255,255,0.3)]">
                    SECURE ACCESS PROTOCOL v3.7.2
                </p>
                <div class="h-[2px] mt-4 bg-gradient-to-r from-cyan-500 to-pink-500 
                            shadow-[0_0_10px_rgba(0,255,255,0.5)]"></div>
            </div>

            <!-- Form -->
            <form @submit.prevent="submit" class="space-y-6">
                <div>
                    <div class="flex justify-between items-center text-xs text-cyan-300 mb-2">
                        <span class="tracking-wider opacity-80 
                                     drop-shadow-[0_0_5px_rgba(0,255,255,0.5)]">
                            ENCRYPTED COMMUNICATION CHANNEL
                        </span>
                        <span class="text-pink-400 font-mono 
                                     drop-shadow-[0_0_5px_rgba(255,0,255,0.5)]">
                            [SECURE_INPUT]
                        </span>
                    </div>

                    <input 
                        type="email" 
                        v-model="form.email" 
                        required 
                        autofocus 
                        autocomplete="username"
                        class="w-full px-4 py-3 
                               bg-black/60 text-cyan-200 
                               border-2 border-cyan-500/30 
                               placeholder-cyan-500/50
                               focus:border-pink-500 
                               transition-colors 
                               duration-300
                               tracking-wider
                               shadow-inner
                               focus:ring-2 focus:ring-pink-500/50"
                        :class="{
                            'border-red-500': form.errors.email,
                            'border-green-500': isValidEmail
                        }"
                        placeholder="agent@cybertweet.protocol" 
                    />

                    <p v-if="form.errors.email" class="text-red-400 text-xs mt-2 flex items-center 
                             drop-shadow-[0_0_5px_rgba(255,0,0,0.5)]">
                        <span class="mr-2 text-red-500">⚠</span>
                        {{ form.errors.email }}
                    </p>
                </div>

                <button 
                    type="submit" 
                    :disabled="form.processing || !isValidEmail"
                    class="w-full py-4 
                           bg-gradient-to-r from-cyan-600/80 to-pink-600/80
                           hover:from-cyan-500 hover:to-pink-500
                           text-white 
                           font-bold 
                           uppercase 
                           tracking-wider 
                           rounded
                           transition-all 
                           duration-500
                           disabled:opacity-30
                           shadow-2xl
                           hover:shadow-cyan-500/50
                           focus:outline-none 
                           focus:ring-2 
                           focus:ring-pink-500/50"
                >
                    <span class="block 
                                 drop-shadow-[0_0_10px_rgba(0,255,255,0.5)]">
                        Initiate Recovery
                    </span>
                    <span class="block text-xs mt-1 
                                 text-cyan-300 
                                 opacity-70 
                                 tracking-[0.2em]
                                 drop-shadow-[0_0_5px_rgba(0,255,255,0.3)]">
                        QUANTUM_SECURE_TRANSMISSION
                    </span>
                </button>
            </form>

            <div class="mt-6 text-center">
                <Link 
                    :href="route('login')" 
                    class="text-cyan-400 
                           hover:text-pink-500 
                           transition-colors 
                           tracking-wider 
                           text-sm
                           drop-shadow-[0_0_5px_rgba(0,255,255,0.3)]"
                >
                    Back to Login
                </Link>
            </div>
        </div>
    </div>
</template>

<style scoped>
/* Removed all custom CSS classes */
@keyframes quantum-pulse {
    0%, 100% {
        transform: translate(-50%, -50%) scale(1) rotate(0deg);
        opacity: 0.3;
    }
    50% {
        transform: translate(-50%, -50%) scale(1.2) rotate(180deg);
        opacity: 0.5;
    }
}
</style>
