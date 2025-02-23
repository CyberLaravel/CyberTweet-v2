<script setup>
import { Head, useForm } from '@inertiajs/vue3';

const props = defineProps({
    email: String,
    token: String,
});

const form = useForm({
    token: props.token,
    email: props.email,
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('password.update'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <Head title="Reset Password" />

    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-black relative overflow-hidden cyberpunk-scene">
        <!-- Holographic Grid -->
        <div class="absolute inset-0 bg-[length:40px_40px] bg-grid-neon opacity-20 animate-grid-move"></div>
        
        <!-- Core Energy Pulse -->
        <div class="absolute w-[600px] h-[600px] bg-gradient-to-r from-cyan-500/20 to-pink-500/20 rounded-full blur-[150px] animate-energy-pulse"></div>

        <div class="w-full sm:max-w-md mt-6 px-6 py-8 bg-black/90 backdrop-blur-xl border-2 border-cyan-500/50 shadow-cyberpunk relative z-10 neon-panel">
            <!-- Crypto Reset Header -->
            <div class="text-center mb-8 holographic-header">
                <h1 class="text-4xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-cyan-400 to-pink-400 animate-text-glitch">
                    CIPHER RESET
                </h1>
                <div class="h-1 mt-2 bg-gradient-to-r from-cyan-500 to-pink-500 animate-line-glow"></div>
                <div class="text-sm text-cyan-400 mt-2 font-mono">CRYPTOGRAPHIC PROTOCOL v3.1.4</div>
            </div>

            <form @submit.prevent="submit" class="space-y-6">
                <!-- Hidden Email Field -->
                <input type="hidden" name="email" v-model="form.email" />

                <!-- Password Inputs -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="cyber-input-group">
                        <label class="cyber-label">NEW CIPHER</label>
                        <div class="cyber-input-container">
                            <input 
                                type="password" 
                                v-model="form.password"
                                required
                                autocomplete="new-password"
                                class="cyber-input"
                                placeholder="••••••••"
                            />
                            <div class="cyber-input-decoration"></div>
                        </div>
                        <p v-if="form.errors.password" class="cyber-error">{{ form.errors.password }}</p>
                    </div>

                    <div class="cyber-input-group">
                        <label class="cyber-label">CONFIRM CIPHER</label>
                        <div class="cyber-input-container">
                            <input 
                                type="password" 
                                v-model="form.password_confirmation"
                                required
                                autocomplete="new-password"
                                class="cyber-input"
                                placeholder="••••••••"
                            />
                            <div class="cyber-input-decoration"></div>
                        </div>
                        <p v-if="form.errors.password_confirmation" class="cyber-error">{{ form.errors.password_confirmation }}</p>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end">
                    <button 
                        type="submit" 
                        :disabled="form.processing"
                        class="cyber-button"
                    >
                        <span class="cyber-button-content">
                            ENGAGE RESET
                            <span class="cyber-button-glitch">SYSTEM_OVERDRIVE</span>
                        </span>
                    </button>
                </div>
            </form>
        </div>

        <!-- System Overlay Effects -->
        <div class="absolute inset-0 scanning-line"></div>
        <div class="absolute inset-0 data-stream"></div>
    </div>
</template>

<style>
/* Crypto-specific Styles */
.crypto-glitch {
    animation: crypto-glitch 2s infinite;
}

@keyframes crypto-glitch {
    0% { text-shadow: 2px 2px #ff00ff, -2px -2px #00ffff; }
    25% { text-shadow: -2px 2px #ff00ff, 2px -2px #00ffff; }
    50% { text-shadow: 2px -2px #ff00ff, -2px 2px #00ffff; }
    75% { text-shadow: -2px -2px #ff00ff, 2px 2px #00ffff; }
    100% { text-shadow: 2px 2px #ff00ff, -2px -2px #00ffff; }
}
</style>
