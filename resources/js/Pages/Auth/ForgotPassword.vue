<script setup>
import { ref } from 'vue';
import { Head, useForm } from '@inertiajs/vue3';

const form = useForm({
    email: '',
});

const isHovered = ref(false);
const isSubmitting = ref(false);

const submit = () => {
    isSubmitting.value = true;
    form.post(route('password.email'), {
        onFinish: () => {
            isSubmitting.value = false;
        }
    });
};
</script>

<template>

    <Head title="Crypto Recovery" />

    <div class="min-h-screen flex items-center justify-center bg-black overflow-hidden relative cyberpunk-matrix">
        <!-- Enhanced Matrix Background -->
        <div class="absolute inset-0 pointer-events-none matrix-background">
            <div class="absolute inset-0 grid-overlay opacity-15"></div>
            <div class="absolute inset-0 hex-overlay opacity-10"></div>
            <div class="absolute inset-0 data-stream-overlay"></div>
        </div>

        <!-- Enhanced Energy Core -->
        <div class="quantum-core"></div>

        <!-- Main Container -->
        <div class="relative z-10 w-full max-w-md p-8 
                    bg-gradient-to-br from-black/90 to-black/70 
                    border-2 border-cyan-500/30 
                    backdrop-blur-xl rounded-xl shadow-neon 
                    transform hover:scale-[1.01] transition-all duration-500">

            <!-- Enhanced Header -->
            <div class="cyber-header mb-10">
                <div class="glitch-wrapper">
                    <h1 class="cyber-title">CRYPTO RECOVERY</h1>
                    <div class="cyber-subtitle">SECURITY PROTOCOL v3.7.2</div>
                </div>
                <div class="cyber-decorative-bar"></div>
            </div>

            <!-- Enhanced Status Display -->
            <div v-if="status" class="cyber-status-display mb-6">
                <div class="status-content">
                    <span class="status-indicator"></span>
                    <span class="status-text">{{ status }}</span>
                </div>
            </div>

            <!-- Enhanced Form -->
            <form @submit.prevent="submit" class="space-y-6">
                <div class="cyber-input-group">
                    <label class="cyber-label">
                        <span class="label-text">ENCRYPTED CHANNEL</span>
                        <span class="label-tag">[SECURE_INPUT]</span>
                    </label>

                    <div class="cyber-input-wrapper">
                        <input type="email" v-model="form.email" required autofocus autocomplete="username"
                            @focus="isHovered = true" @blur="isHovered = false" class="cyber-input"
                            placeholder="agent@cyber.protocol" />
                        <div class="cyber-input-fx"></div>
                    </div>

                    <p v-if="form.errors.email" class="cyber-error">
                        <span class="error-icon">⚠</span>
                        {{ form.errors.email }}
                    </p>
                </div>

                <button type="submit" :disabled="form.processing" class="cyber-button"
                    :class="{ 'is-processing': isSubmitting }">
                    <div class="button-content">
                        <span class="button-text">Initiate Recovery</span>
                        <span class="button-subtext">QUANTUM_SECURE_TRANSMISSION</span>
                    </div>
                    <div class="button-fx"></div>
                </button>
            </form>
        </div>
    </div>
</template>

<style scoped>
.matrix-background {
    background: radial-gradient(circle at center, #000922 0%, #000 100%);
}

.quantum-core {
    @apply absolute -top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2;
    width: 150vh;
    height: 150vh;
    background: radial-gradient(circle at center,
            rgba(0, 255, 255, 0.1) 0%,
            rgba(255, 0, 255, 0.1) 50%,
            transparent 100%);
    filter: blur(100px);
    animation: quantum-pulse 15s ease-in-out infinite;
}

.cyber-header {
    @apply relative text-center;
}

.cyber-title {
    @apply text-5xl font-bold uppercase;
    background: linear-gradient(45deg, #00ffff, #ff00ff);
    -webkit-background-clip: text;
    background-clip: text;
    color: transparent;
    text-shadow: 0 0 20px rgba(0, 255, 255, 0.5);
}

.cyber-subtitle {
    @apply text-sm text-cyan-400 mt-2 font-mono tracking-widest;
    text-shadow: 0 0 10px rgba(0, 255, 255, 0.5);
}

.cyber-decorative-bar {
    @apply h-1 mt-4 bg-gradient-to-r from-cyan-500 to-pink-500;
    box-shadow: 0 0 20px rgba(0, 255, 255, 0.5);
}

.cyber-input {
    @apply w-full px-4 py-3 bg-black/50 text-cyan-300;
    @apply border-2 border-cyan-500/30;
    @apply focus:border-pink-500 transition-all duration-300;
    box-shadow: inset 0 0 20px rgba(0, 255, 255, 0.1);
}

.cyber-button {
    @apply w-full py-4 relative overflow-hidden;
    @apply bg-gradient-to-r from-cyan-600 to-pink-600;
    @apply hover:from-cyan-500 hover:to-pink-500;
    @apply disabled:opacity-50 transition-all duration-500;
    box-shadow: 0 0 30px rgba(0, 255, 255, 0.2);
}

.button-content {
    @apply relative z-10 text-center;
}

.button-text {
    @apply text-white font-bold uppercase tracking-wider;
    text-shadow: 0 0 10px rgba(0, 255, 255, 0.5);
}

.button-subtext {
    @apply block text-xs mt-1 opacity-70;
}

.cyber-status-display {
    @apply p-4 bg-black/60 border border-cyan-500/30;
    @apply text-green-400 font-mono text-sm;
    box-shadow: inset 0 0 20px rgba(0, 255, 255, 0.1);
}

.status-indicator {
    @apply inline-block w-2 h-2 bg-green-500 rounded-full mr-2;
    animation: blink 1s infinite;
}

@keyframes blink {

    0%,
    100% {
        opacity: 1;
    }

    50% {
        opacity: 0.2;
    }
}

@keyframes quantum-pulse {

    0%,
    100% {
        transform: translate(-50%, -50%) scale(1) rotate(0deg);
        opacity: 0.3;
    }

    50% {
        transform: translate(-50%, -50%) scale(1.2) rotate(180deg);
        opacity: 0.5;
    }
}
</style>
