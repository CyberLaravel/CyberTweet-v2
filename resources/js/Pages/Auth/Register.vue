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
    <Head title="System Registration" />

    <div class="min-h-screen bg-[#001122] flex items-center justify-center p-6 relative overflow-hidden">
        <!-- Cyberpunk Background Effects -->
        <div class="absolute inset-0 bg-grid-neon opacity-5"></div>
        <div class="absolute top-0 left-1/4 w-96 h-96 bg-[#00FFFF]/10 rounded-full blur-[128px] animate-pulse"></div>
        <div class="absolute bottom-0 right-1/4 w-96 h-96 bg-[#FF00FF]/10 rounded-full blur-[128px] animate-pulse delay-1000"></div>

        <!-- Registration Form -->
        <div class="w-full max-w-md relative">
            <!-- Neon Border Effect -->
            <div class="absolute -inset-[2px] bg-gradient-to-r from-[#00FFFF] via-[#FF00FF] to-[#00FFFF] rounded-lg opacity-30 blur"></div>
            
            <div class="relative bg-[#001122]/95 backdrop-blur-xl border border-[#00FFFF]/20 rounded-lg p-8 shadow-[0_0_50px_rgba(0,255,255,0.1)]">
                <!-- Header -->
                <div class="text-center mb-8">
                    <h1 class="text-3xl font-light tracking-wider font-['Orbitron']">
                        <span class="text-[#00FFFF]">Cyber</span>
                        <span class="text-[#FF00FF]">Tweet</span>
                    </h1>
                    <p class="mt-2 text-[#00FFFF]/60 text-sm uppercase tracking-[0.2em]">System Registration</p>
                    <div class="h-[1px] w-24 mx-auto mt-4 bg-gradient-to-r from-transparent via-[#00FFFF]/50 to-transparent"></div>
                </div>

                <form @submit.prevent="submit" class="space-y-6">
                    <!-- Name Input -->
                    <div>
                        <label class="block text-[#00FFFF]/80 text-sm mb-2">OPERATIVE ID</label>
                        <input
                            v-model="form.name"
                            type="text"
                            required
                            class="w-full bg-[#001122] border border-[#00FFFF]/20 rounded-lg px-4 py-3 text-white placeholder-[#00FFFF]/30 focus:border-[#00FFFF]/60 focus:ring-1 focus:ring-[#00FFFF]/50 transition-all duration-300"
                            placeholder="Enter your name"
                        />
                        <p v-if="form.errors.name" class="mt-1 text-sm text-[#FF00FF]">{{ form.errors.name }}</p>
                    </div>

                    <!-- Email Input -->
                    <div>
                        <label class="block text-[#00FFFF]/80 text-sm mb-2">NEURAL LINK</label>
                        <input
                            v-model="form.email"
                            type="email"
                            required
                            class="w-full bg-[#001122] border border-[#00FFFF]/20 rounded-lg px-4 py-3 text-white placeholder-[#00FFFF]/30 focus:border-[#00FFFF]/60 focus:ring-1 focus:ring-[#00FFFF]/50 transition-all duration-300"
                            placeholder="your@email.com"
                        />
                        <p v-if="form.errors.email" class="mt-1 text-sm text-[#FF00FF]">{{ form.errors.email }}</p>
                    </div>

                    <!-- Password Fields -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Password -->
                        <div>
                            <label class="block text-[#00FFFF]/80 text-sm mb-2">ACCESS KEY</label>
                            <div class="relative">
                                <input
                                    v-model="form.password"
                                    :type="passwordVisible ? 'text' : 'password'"
                                    required
                                    class="w-full bg-[#001122] border border-[#00FFFF]/20 rounded-lg px-4 py-3 text-white placeholder-[#00FFFF]/30 focus:border-[#00FFFF]/60 focus:ring-1 focus:ring-[#00FFFF]/50 transition-all duration-300"
                                    placeholder="••••••••"
                                />
                                <button
                                    type="button"
                                    @click="togglePasswordVisibility('password')"
                                    class="absolute right-3 top-1/2 -translate-y-1/2 text-[#00FFFF]/60 hover:text-[#00FFFF] transition-colors"
                                >
                                    <svg v-if="passwordVisible" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                    <svg v-else class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                                    </svg>
                                </button>
                            </div>
                            <p v-if="form.errors.password" class="mt-1 text-sm text-[#FF00FF]">{{ form.errors.password }}</p>
                        </div>

                        <!-- Confirm Password -->
                        <div>
                            <label class="block text-[#00FFFF]/80 text-sm mb-2">VERIFY KEY</label>
                            <div class="relative">
                                <input
                                    v-model="form.password_confirmation"
                                    :type="confirmPasswordVisible ? 'text' : 'password'"
                                    required
                                    class="w-full bg-[#001122] border border-[#00FFFF]/20 rounded-lg px-4 py-3 text-white placeholder-[#00FFFF]/30 focus:border-[#00FFFF]/60 focus:ring-1 focus:ring-[#00FFFF]/50 transition-all duration-300"
                                    placeholder="••••••••"
                                />
                                <button
                                    type="button"
                                    @click="togglePasswordVisibility('confirm')"
                                    class="absolute right-3 top-1/2 -translate-y-1/2 text-[#00FFFF]/60 hover:text-[#00FFFF] transition-colors"
                                >
                                    <svg v-if="confirmPasswordVisible" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                    <svg v-else class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Terms Checkbox -->
                    <div v-if="$page.props.jetstream.hasTermsAndPrivacyPolicyFeature" class="flex items-center space-x-3">
                        <input
                            type="checkbox"
                            v-model="form.terms"
                            required
                            class="rounded border-[#00FFFF]/20 bg-[#001122] text-[#00FFFF] focus:ring-[#00FFFF]/50 transition-colors"
                        />
                        <span class="text-sm text-[#00FFFF]/60">
                            I agree to the
                            <Link :href="route('terms.show')" class="text-[#FF00FF] hover:text-[#00FFFF] transition-colors">
                                Terms of Service
                            </Link>
                        </span>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex items-center justify-between pt-2">
                        <Link
                            :href="route('login')"
                            class="text-[#00FFFF]/60 hover:text-[#00FFFF] text-sm transition-colors"
                        >
                            ← Return to Login
                        </Link>

                        <button
                            type="submit"
                            :disabled="form.processing"
                            class="relative px-6 py-2 bg-gradient-to-r from-[#00FFFF] to-[#FF00FF] text-white rounded-lg overflow-hidden transition-all duration-300 hover:opacity-90 disabled:opacity-50"
                        >
                            <span class="relative z-10">INITIALIZE</span>
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
</style>
