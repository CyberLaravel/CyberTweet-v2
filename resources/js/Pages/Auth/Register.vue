<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
    terms: false,
});

const passwordVisible = ref(false);
const confirmPasswordVisible = ref(false);

const togglePasswordVisibility = (type) => {
    if (type === 'password') {
        passwordVisible.value = !passwordVisible.value;
    } else {
        confirmPasswordVisible.value = !confirmPasswordVisible.value;
    }
};

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <Head title="Cyber Registration" />

    <div class="min-h-screen bg-[#0a0a1a] flex items-center justify-center p-4 overflow-hidden relative">
        <!-- Neon Grid Background -->
        <div class="absolute inset-0 bg-grid-neon opacity-10 pointer-events-none"></div>
        
        <!-- Glowing Accent Shapes -->
        <div class="absolute -top-1/4 -right-1/4 w-[600px] h-[600px] bg-cyan-500/20 rounded-full blur-[200px] animate-pulse"></div>
        <div class="absolute -bottom-1/4 -left-1/4 w-[500px] h-[500px] bg-pink-500/20 rounded-full blur-[200px] animate-pulse delay-500"></div>

        <!-- Registration Container -->
        <div class="relative z-10 w-full max-w-md bg-[#0f1229] border-2 border-cyan-500/30 rounded-xl shadow-2xl shadow-cyan-500/20 p-8">
            <div class="text-center mb-8">
                <h1 class="text-4xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-cyan-400 to-pink-400 mb-2">
                    SYSTEM INFILTRATION
                </h1>
                <p class="text-xs text-cyan-300 tracking-widest uppercase">New Operative Registration</p>
                <div class="h-0.5 bg-gradient-to-r from-cyan-500 to-pink-500 mt-2 mx-auto w-1/2"></div>
            </div>

            <form @submit.prevent="submit" class="space-y-6">
                <!-- Operative ID -->
                <div class="relative">
                    <label class="block text-sm text-cyan-300 mb-2">OPERATIVE IDENTIFIER</label>
                    <input 
                        type="text" 
                        v-model="form.name"
                        required
                        autofocus
                        class="w-full bg-[#1a1e3a] border-2 border-cyan-500/30 text-cyan-100 rounded-lg py-3 px-4 focus:outline-none focus:border-cyan-300 transition-all duration-300"
                        placeholder="CYBER-AGENT-[ID]"
                    />
                    <div v-if="form.errors.name" class="text-xs text-pink-400 mt-1">
                        {{ form.errors.name }}
                    </div>
                </div>

                <!-- Encrypted Channel -->
                <div class="relative">
                    <label class="block text-sm text-cyan-300 mb-2">ENCRYPTED COMMUNICATION NODE</label>
                    <input 
                        type="email" 
                        v-model="form.email"
                        required
                        class="w-full bg-[#1a1e3a] border-2 border-cyan-500/30 text-cyan-100 rounded-lg py-3 px-4 focus:outline-none focus:border-cyan-300 transition-all duration-300"
                        placeholder="secure.transmission@network.cyber"
                    />
                    <div v-if="form.errors.email" class="text-xs text-pink-400 mt-1">
                        {{ form.errors.email }}
                    </div>
                </div>

                <!-- Password Fields -->
                <div class="grid grid-cols-2 gap-4">
                    <!-- Primary Password -->
                    <div>
                        <label class="block text-sm text-cyan-300 mb-2">ACCESS KEY</label>
                        <div class="relative">
                            <input 
                                :type="passwordVisible ? 'text' : 'password'"
                                v-model="form.password"
                                required
                                class="w-full bg-[#1a1e3a] border-2 border-cyan-500/30 text-cyan-100 rounded-lg py-3 px-4 pr-10 focus:outline-none focus:border-cyan-300 transition-all duration-300"
                                placeholder="••••••••"
                            />
                            <button 
                                type="button" 
                                @click="togglePasswordVisibility('password')"
                                class="absolute right-3 top-1/2 -translate-y-1/2 text-cyan-300 hover:text-cyan-100"
                            >
                                <i :class="passwordVisible ? 'fa-eye-slash' : 'fa-eye'" class="fas"></i>
                            </button>
                        </div>
                        <div v-if="form.errors.password" class="text-xs text-pink-400 mt-1">
                            {{ form.errors.password }}
                        </div>
                    </div>

                    <!-- Confirmation Password -->
                    <div>
                        <label class="block text-sm text-cyan-300 mb-2">CONFIRM KEY</label>
                        <div class="relative">
                            <input 
                                :type="confirmPasswordVisible ? 'text' : 'password'"
                                v-model="form.password_confirmation"
                                required
                                class="w-full bg-[#1a1e3a] border-2 border-cyan-500/30 text-cyan-100 rounded-lg py-3 px-4 pr-10 focus:outline-none focus:border-cyan-300 transition-all duration-300"
                                placeholder="••••••••"
                            />
                            <button 
                                type="button" 
                                @click="togglePasswordVisibility('confirm')"
                                class="absolute right-3 top-1/2 -translate-y-1/2 text-cyan-300 hover:text-cyan-100"
                            >
                                <i :class="confirmPasswordVisible ? 'fa-eye-slash' : 'fa-eye'" class="fas"></i>
                            </button>
                        </div>
                        <div v-if="form.errors.password_confirmation" class="text-xs text-pink-400 mt-1">
                            {{ form.errors.password_confirmation }}
                        </div>
                    </div>
                </div>

                <!-- Terms Acknowledgement -->
                <div v-if="$page.props.jetstream.hasTermsAndPrivacyPolicyFeature" class="flex items-center space-x-3">
                    <input 
                        type="checkbox"
                        v-model="form.terms"
                        required
                        class="form-checkbox bg-transparent border-2 border-cyan-500 text-cyan-500 rounded focus:ring-2 focus:ring-cyan-300"
                    />
                    <label class="text-sm text-cyan-300">
                        I acknowledge the 
                        <Link :href="route('terms.show')" class="text-pink-400 hover:text-cyan-300 underline">
                            System Protocols
                        </Link>
                    </label>
                </div>

                <!-- Action Buttons -->
                <div class="flex justify-between items-center mt-6">
                    <Link 
                        :href="route('login')" 
                        class="text-cyan-300 hover:text-cyan-100 transition-colors"
                    >
                        ← Existing Operative Login
                    </Link>

                    <button 
                        type="submit" 
                        :disabled="form.processing"
                        class="bg-gradient-to-r from-cyan-500 to-pink-500 text-white py-3 px-6 rounded-lg hover:opacity-90 transition-all duration-300 relative overflow-hidden"
                    >
                        <span class="relative z-10">INITIALIZE PROTOCOL</span>
                        <div class="absolute inset-0 bg-gradient-to-r from-cyan-500/30 to-pink-500/30 opacity-0 hover:opacity-100 transition-opacity duration-300"></div>
                    </button>
                </div>
            </form>
        </div>

        <!-- Scanline Effect -->
        <div class="fixed inset-0 pointer-events-none z-20 opacity-10">
            <div class="absolute inset-0 bg-gradient-to-b from-transparent via-cyan-500/10 to-transparent animate-scanline"></div>
        </div>
    </div>
</template>

<style scoped>
@keyframes scanline {
    0% { transform: translateY(-100%); }
    100% { transform: translateY(100vh); }
}

.bg-grid-neon {
    background-image: 
        linear-gradient(to right, rgba(0,247,255,0.1) 1px, transparent 1px),
        linear-gradient(to bottom, rgba(0,247,255,0.1) 1px, transparent 1px);
    background-size: 30px 30px;
}

.animate-scanline {
    animation: scanline 5s linear infinite;
}
</style>
