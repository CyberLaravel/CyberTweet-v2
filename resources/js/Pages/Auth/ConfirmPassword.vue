<script setup>
import { ref } from 'vue';
import { Head, useForm } from '@inertiajs/vue3';

const form = useForm({
    password: '',
});

const passwordInput = ref(null);

const submit = () => {
    form.post(route('password.confirm'), {
        onFinish: () => {
            form.reset();
            passwordInput.value.focus();
        },
    });
};
</script>

<template>
    <Head title="Secure Area" />

    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-black relative overflow-hidden cyberpunk-scene">
        <!-- Holographic Grid -->
        <div class="absolute inset-0 bg-[length:40px_40px] bg-grid-neon opacity-20 animate-grid-move"></div>
        
        <!-- Core Energy Pulse -->
        <div class="absolute w-[600px] h-[600px] bg-gradient-to-r from-cyan-500/20 to-pink-500/20 rounded-full blur-[150px] animate-energy-pulse"></div>

        <div class="w-full sm:max-w-md mt-6 px-6 py-8 bg-black/90 backdrop-blur-xl border-2 border-cyan-500/50 shadow-cyberpunk relative z-10 neon-panel">
            <!-- Security Header -->
            <div class="text-center mb-8 holographic-header">
                <h1 class="text-4xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-cyan-400 to-pink-400 animate-text-glitch">
                    SECURITY LOCKER
                </h1>
                <div class="h-1 mt-2 bg-gradient-to-r from-cyan-500 to-pink-500 animate-line-glow"></div>
                <div class="text-sm text-cyan-400 mt-2 font-mono">SECURITY PROTOCOL v4.2.1</div>
            </div>

            <div class="mb-4 text-sm text-cyan-400 terminal-box">
                <span class="blink">></span> Confirm security clearance to continue
            </div>

            <form @submit.prevent="submit" class="space-y-6">
                <!-- Password Input -->
                <div class="cyber-input-group">
                    <label class="cyber-label">MASTER KEY</label>
                    <div class="cyber-input-container">
                        <input 
                            id="password"
                            ref="passwordInput"
                            type="password" 
                            v-model="form.password"
                            required
                            autocomplete="current-password"
                            autofocus
                            class="cyber-input"
                            placeholder="••••••••"
                        />
                        <div class="cyber-input-decoration"></div>
                    </div>
                    <p v-if="form.errors.password" class="cyber-error">{{ form.errors.password }}</p>
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end">
                    <button 
                        type="submit" 
                        :disabled="form.processing"
                        class="cyber-button"
                    >
                        <span class="cyber-button-content">
                            VERIFY IDENTITY
                            <span class="cyber-button-glitch">SECURITY_OVERRIDE</span>
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
/* Security-specific Styles */
.security-terminal {
    border: 2px solid rgba(0, 247, 255, 0.3);
    background: linear-gradient(
        45deg,
        rgba(0, 0, 0, 0.8) 0%,
        rgba(0, 13, 13, 0.8) 100%
    );
    box-shadow: 0 0 30px rgba(0, 247, 255, 0.1);
}

.security-pulse {
    animation: security-pulse 2s infinite;
}

@keyframes security-pulse {
    0% { box-shadow: 0 0 0 0 rgba(0, 247, 255, 0.2); }
    70% { box-shadow: 0 0 0 15px rgba(0, 247, 255, 0); }
    100% { box-shadow: 0 0 0 0 rgba(0, 247, 255, 0); }
}
</style>
