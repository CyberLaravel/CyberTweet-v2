<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
    terms: false,
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <Head title="Register" />

    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-black relative overflow-hidden cyberpunk-scene">
        <!-- Holographic Grid -->
        <div class="absolute inset-0 bg-[length:40px_40px] bg-grid-neon opacity-20 animate-grid-move"></div>
        
        <!-- Core Energy Pulse -->
        <div class="absolute w-[600px] h-[600px] bg-gradient-to-r from-cyan-500/20 to-pink-500/20 rounded-full blur-[150px] animate-energy-pulse"></div>

        <div class="w-full sm:max-w-md mt-6 px-6 py-8 bg-black/90 backdrop-blur-xl border-2 border-cyan-500/50 shadow-cyberpunk relative z-10 neon-panel">
            <!-- Animated Header -->
            <div class="text-center mb-8 holographic-header">
                <h1 class="text-5xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-cyan-400 to-pink-400 animate-text-glitch">
                    SYSTEM ACCESS
                </h1>
                <div class="h-1 mt-2 bg-gradient-to-r from-cyan-500 to-pink-500 animate-line-glow"></div>
                <div class="text-sm text-cyan-400 mt-2 font-mono">REGISTRATION PROTOCOL v2.3.5</div>
            </div>

            <form @submit.prevent="submit" class="space-y-6">
                <!-- Name Input -->
                <div class="cyber-input-group">
                    <label class="cyber-label">OPERATIVE ID</label>
                    <div class="cyber-input-container">
                        <input 
                            type="text" 
                            v-model="form.name"
                            required
                            autofocus
                            autocomplete="name"
                            class="cyber-input"
                            placeholder="CYBER-AGENT-01"
                        />
                        <div class="cyber-input-decoration"></div>
                    </div>
                    <p v-if="form.errors.name" class="cyber-error">{{ form.errors.name }}</p>
                </div>

                <!-- Email Input -->
                <div class="cyber-input-group">
                    <label class="cyber-label">ENCRYPTED CHANNEL</label>
                    <div class="cyber-input-container">
                        <input 
                            type="email" 
                            v-model="form.email"
                            required
                            autocomplete="username"
                            class="cyber-input"
                            placeholder="secure@cyber.net"
                        />
                        <div class="cyber-input-decoration"></div>
                    </div>
                    <p v-if="form.errors.email" class="cyber-error">{{ form.errors.email }}</p>
                </div>

                <!-- Password Inputs -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="cyber-input-group">
                        <label class="cyber-label">CIPHER KEY</label>
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
                        <label class="cyber-label">KEY CONFIRM</label>
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

                <!-- Terms Checkbox -->
                <div v-if="$page.props.jetstream.hasTermsAndPrivacyPolicyFeature" class="cyber-checkbox-group">
                    <input 
                        id="terms"
                        type="checkbox"
                        v-model="form.terms"
                        required
                        class="cyber-checkbox-input"
                    />
                    <label htmlFor="terms" class="cyber-checkbox-label">
                        ACKNOWLEDGE <a :href="route('terms.show')" class="cyber-link-inline">TERMS</a> & 
                        <a :href="route('policy.show')" class="cyber-link-inline">DIRECTIVES</a>
                    </label>
                </div>

                <!-- Form Actions -->
                <div class="flex items-center justify-between mt-8">
                    <Link 
                        :href="route('login')" 
                        class="cyber-link"
                    >
                        > EXISTING OPERATIVE
                    </Link>

                    <button 
                        type="submit" 
                        :disabled="form.processing"
                        class="cyber-button"
                    >
                        <span class="cyber-button-content">
                            INITIATE PROTOCOL
                            <span class="cyber-button-glitch">ACCESS_REQUESTED</span>
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
/* Enhanced Cyberpunk Styles */
.holographic-header {
    position: relative;
    overflow: hidden;
}

.holographic-header::after {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 50%;
    height: 100%;
    background: linear-gradient(
        to right,
        transparent 0%,
        rgba(0, 247, 255, 0.1) 50%,
        transparent 100%
    );
    animation: hologram-sweep 3s infinite;
}

.data-stream {
    background: repeating-linear-gradient(
        0deg,
        transparent 0px,
        transparent 5px,
        rgba(0, 247, 255, 0.05) 5px,
        rgba(0, 247, 255, 0.05) 10px
    );
    animation: data-stream 20s linear infinite;
}

.cyber-checkbox-group {
    @apply flex items-center space-x-2 p-3 border border-cyan-500/30 bg-black/50;
}

.cyber-link-inline {
    @apply text-pink-400 hover:text-cyan-400 transition-colors duration-300;
}

@keyframes energy-pulse {
    0% { opacity: 0.1; transform: scale(0.8); }
    50% { opacity: 0.3; transform: scale(1.2); }
    100% { opacity: 0.1; transform: scale(0.8); }
}

@keyframes hologram-sweep {
    0% { left: -100%; }
    100% { left: 200%; }
}

@keyframes data-stream {
    from { background-position: 0 0; }
    to { background-position: 0 100vh; }
}
</style>
