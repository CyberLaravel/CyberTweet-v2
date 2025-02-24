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
    <Head title="Security Protocol" />

    <div class="min-h-screen bg-[#001122] flex items-center justify-center p-6 relative overflow-hidden">
        <!-- Cyberpunk Background Effects -->
        <div class="absolute inset-0 bg-grid-neon opacity-5"></div>
        <div class="absolute top-0 left-1/4 w-96 h-96 bg-[#00FFFF]/10 rounded-full blur-[128px] animate-pulse"></div>
        <div class="absolute bottom-0 right-1/4 w-96 h-96 bg-[#FF00FF]/10 rounded-full blur-[128px] animate-pulse delay-1000"></div>

        <!-- Security Form -->
        <div class="w-full max-w-md relative">
            <!-- Logo -->
            <div class="text-center mb-8">
                <h1 class="text-4xl font-light tracking-wider font-['Orbitron'] relative">
                    <span class="relative inline-block">
                        <span class="relative z-10">
                            <span class="text-[#00FFFF]">Security</span>
                            <span class="text-[#FF00FF]">Protocol</span>
                        </span>
                        <span class="absolute inset-0 text-[#00FFFF] opacity-50 glitch-1"></span>
                        <span class="absolute inset-0 text-[#FF00FF] opacity-50 glitch-2"></span>
                    </span>
                </h1>
                <p class="mt-2 text-[#00FFFF]/60 text-sm uppercase tracking-[0.2em]">Secure Area Access</p>
                <div class="h-[1px] w-24 mx-auto mt-4 bg-gradient-to-r from-transparent via-[#00FFFF]/50 to-transparent"></div>
            </div>

            <!-- Neon Border Effect -->
            <div class="absolute -inset-[2px] bg-gradient-to-r from-[#00FFFF] via-[#FF00FF] to-[#00FFFF] rounded-lg opacity-30 blur"></div>
            
            <div class="relative bg-[#001122]/95 backdrop-blur-xl border border-[#00FFFF]/20 rounded-lg p-8 shadow-[0_0_50px_rgba(0,255,255,0.1)]">
                <!-- Corner Accents -->
                <div class="absolute top-0 left-0 w-2 h-2 border-l-2 border-t-2 border-[#00FFFF]/50"></div>
                <div class="absolute top-0 right-0 w-2 h-2 border-r-2 border-t-2 border-[#00FFFF]/50"></div>
                <div class="absolute bottom-0 left-0 w-2 h-2 border-l-2 border-b-2 border-[#00FFFF]/50"></div>
                <div class="absolute bottom-0 right-0 w-2 h-2 border-r-2 border-b-2 border-[#00FFFF]/50"></div>

                <div class="mb-6 text-[#00FFFF]/80 text-sm leading-relaxed">
                    This is a secure area. Please confirm your access key before continuing.
                </div>

                <form @submit.prevent="submit" class="space-y-6">
                    <!-- Password Input -->
                    <div>
                        <label class="block text-[#00FFFF]/80 text-sm mb-2">SECURITY KEY</label>
                        <div class="relative">
                            <input
                                ref="passwordInput"
                                v-model="form.password"
                                type="password"
                                required
                                autocomplete="current-password"
                                class="w-full bg-[#001122] border border-[#00FFFF]/20 rounded-lg px-4 py-3 text-white placeholder-[#00FFFF]/30 focus:border-[#00FFFF]/60 focus:ring-1 focus:ring-[#00FFFF]/50 transition-all duration-300"
                                placeholder="••••••••"
                            />
                            <div class="absolute right-0 top-0 h-full w-[2px] bg-gradient-to-b from-[#00FFFF]/50 via-[#FF00FF]/50 to-transparent"></div>
                        </div>
                        <p v-if="form.errors.password" class="mt-1 text-sm text-[#FF00FF]">{{ form.errors.password }}</p>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-end">
                        <button
                            type="submit"
                            :disabled="form.processing"
                            class="relative px-6 py-2 bg-gradient-to-r from-[#00FFFF] to-[#FF00FF] text-white rounded-lg overflow-hidden transition-all duration-300 hover:opacity-90 disabled:opacity-50 group"
                        >
                            <span class="relative z-10">VERIFY ACCESS</span>
                            <div class="absolute inset-0 bg-white/20 translate-y-12 group-hover:translate-y-0 transition-transform duration-300"></div>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Scanline Effect -->
        <div class="pointer-events-none fixed inset-0">
            <div class="absolute inset-0 bg-[linear-gradient(to_bottom,transparent_50%,rgba(0,255,255,0.1)_50%)] bg-[length:100%_4px] animate-scanline"></div>
        </div>
    </div>
</template>

<style scoped>
@keyframes scanline {
    from { transform: translateY(-100%); }
    to { transform: translateY(100%); }
}

.bg-grid-neon {
    background-image: 
        linear-gradient(to right, rgba(0,255,255,0.05) 1px, transparent 1px),
        linear-gradient(to bottom, rgba(0,255,255,0.05) 1px, transparent 1px);
    background-size: 20px 20px;
}

.animate-scanline {
    animation: scanline 8s linear infinite;
}

.glitch-1 {
    clip-path: polygon(0 0, 100% 0, 100% 45%, 0 45%);
    transform: translate(-2px, 2px);
    animation: glitch 1s infinite linear alternate-reverse;
}

.glitch-2 {
    clip-path: polygon(0 80%, 100% 20%, 100% 100%, 0 100%);
    transform: translate(2px, -2px);
    animation: glitch 2s infinite linear alternate-reverse;
}

@keyframes glitch {
    0% { transform: translate(0); }
    20% { transform: translate(-2px, 2px); }
    40% { transform: translate(-2px, -2px); }
    60% { transform: translate(2px, 2px); }
    80% { transform: translate(2px, -2px); }
    100% { transform: translate(0); }
}
</style>
