<script setup>
import { computed } from 'vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const props = defineProps({
    status: String,
});

const form = useForm({});

const submit = () => {
    form.post(route('verification.send'));
};

const verificationLinkSent = computed(() => props.status === 'verification-link-sent');
</script>

<template>
    <Head title="Neural Link Verification" />

    <div class="min-h-screen bg-[#001122] flex items-center justify-center p-6 relative overflow-hidden">
        <!-- Cyberpunk Background Effects -->
        <div class="absolute inset-0 bg-grid-neon opacity-5"></div>
        <div class="absolute top-0 left-1/4 w-96 h-96 bg-[#00FFFF]/10 rounded-full blur-[128px] animate-pulse"></div>
        <div class="absolute bottom-0 right-1/4 w-96 h-96 bg-[#FF00FF]/10 rounded-full blur-[128px] animate-pulse delay-1000"></div>

        <!-- Verification Form -->
        <div class="w-full max-w-md relative">
            <!-- Logo -->
            <div class="text-center mb-8">
                <h1 class="text-4xl font-light tracking-wider font-['Orbitron'] relative">
                    <span class="relative inline-block">
                        <span class="relative z-10">
                            <span class="text-[#00FFFF]">Neural</span>
                            <span class="text-[#FF00FF]">Verify</span>
                        </span>
                        <span class="absolute inset-0 text-[#00FFFF] opacity-50 glitch-1"></span>
                        <span class="absolute inset-0 text-[#FF00FF] opacity-50 glitch-2"></span>
                    </span>
                </h1>
                <p class="mt-2 text-[#00FFFF]/60 text-sm uppercase tracking-[0.2em]">Link Verification Protocol</p>
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
                    Before proceeding, please verify your neural link by clicking the verification link in your transmission. If you didn't receive the transmission, we'll send you another.
                </div>

                <div v-if="verificationLinkSent" class="mb-6 text-sm text-[#00FF66] bg-[#00FF66]/5 border border-[#00FF66]/20 rounded-lg p-4">
                    A new verification link has been transmitted to your neural link address.
                </div>

                <form @submit.prevent="submit">
                    <div class="flex items-center justify-center space-x-6">
                        <Link
                            :href="route('profile.show')"
                            class="px-4 py-2 text-[#00FFFF] text-sm transition-colors relative group hover:text-[#00FFFF]/80"
                        >
                            EDIT<br>PROFILE
                        </Link>

                        <Link
                            :href="route('logout')"
                            method="post"
                            as="button"
                            class="px-4 py-2 text-[#00FFFF] text-sm transition-colors relative group hover:text-[#00FFFF]/80"
                        >
                            DISCONNECT
                        </Link>

                        <button
                            type="submit"
                            :disabled="form.processing"
                            class="px-6 py-2 bg-gradient-to-r from-[#00FFFF] to-[#FF00FF] text-white rounded-md text-sm font-medium hover:opacity-90 transition-opacity duration-300 disabled:opacity-50"
                        >
                            RESEND<br>TRANSMISSION
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
