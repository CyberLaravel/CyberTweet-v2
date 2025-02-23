<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.transform(data => ({
        ...data,
        remember: form.remember ? 'on' : '',
    })).post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <Head title="Neural Access" />

    <div class="min-h-screen flex items-center justify-center bg-black overflow-hidden relative">
        <!-- Dynamic Background Elements -->
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_center,rgba(0,247,255,0.1)_0%,transparent_70%)] animate-pulse-slow"></div>
        <div class="absolute inset-0 bg-[length:50px_50px] bg-[linear-gradient(to_right,rgba(0,247,255,0.05)_1px,transparent_1px),linear-gradient(to_bottom,rgba(0,247,255,0.05)_1px,transparent_1px)] animate-grid-float opacity-20"></div>

        <!-- Neural Network Animation -->
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div class="neural-paths"></div>
        </div>

        <!-- Main Login Container -->
        <div class="w-full max-w-md p-8 relative z-10">
            <!-- Glitch Effect Logo -->
            <div class="text-center mb-12 glitch-container">
                <h1 class="text-6xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-cyan-400 via-blue-500 to-purple-600 animate-text-shimmer relative">
                    <span class="glitch-text" data-text="CYBERTWEET">CYBERTWEET</span>
                </h1>
                <div class="mt-2 text-cyan-400 font-mono text-sm tracking-wider">NEURAL.ACCESS.PROTOCOL//v2.0</div>
            </div>

            <!-- Login Form -->
            <div class="bg-black/40 backdrop-blur-xl p-8 rounded-lg border border-cyan-500/30 shadow-[0_0_50px_rgba(0,247,255,0.15)] relative overflow-hidden">
                <!-- Animated Corner Decorations -->
                <div class="absolute top-0 left-0 w-2 h-2 border-l-2 border-t-2 border-cyan-500"></div>
                <div class="absolute top-0 right-0 w-2 h-2 border-r-2 border-t-2 border-cyan-500"></div>
                <div class="absolute bottom-0 left-0 w-2 h-2 border-l-2 border-b-2 border-cyan-500"></div>
                <div class="absolute bottom-0 right-0 w-2 h-2 border-r-2 border-b-2 border-cyan-500"></div>

                <form @submit.prevent="submit" class="space-y-6">
                    <!-- Email Field -->
                    <div class="space-y-2">
                        <label class="block text-cyan-400 text-sm font-mono">NEURAL.ID</label>
                        <div class="relative">
                            <input
                                type="email"
                                v-model="form.email"
                                required
                                class="w-full bg-black/50 border border-cyan-500/50 text-cyan-300 px-4 py-3 rounded-sm focus:outline-none focus:border-pink-500 focus:ring-1 focus:ring-pink-500 transition-all duration-300 font-mono"
                                placeholder="agent@neural.net"
                            />
                            <div class="absolute right-0 top-0 h-full w-2 bg-gradient-to-b from-cyan-500/50 to-transparent"></div>
                        </div>
                        <p v-if="form.errors.email" class="text-red-400 text-xs mt-1">{{ form.errors.email }}</p>
                    </div>

                    <!-- Password Field -->
                    <div class="space-y-2">
                        <label class="block text-cyan-400 text-sm font-mono">NEURAL.KEY</label>
                        <div class="relative">
                            <input
                                type="password"
                                v-model="form.password"
                                required
                                class="w-full bg-black/50 border border-cyan-500/50 text-cyan-300 px-4 py-3 rounded-sm focus:outline-none focus:border-pink-500 focus:ring-1 focus:ring-pink-500 transition-all duration-300 font-mono"
                                placeholder="****************"
                            />
                            <div class="absolute right-0 top-0 h-full w-2 bg-gradient-to-b from-cyan-500/50 to-transparent"></div>
                        </div>
                        <p v-if="form.errors.password" class="text-red-400 text-xs mt-1">{{ form.errors.password }}</p>
                    </div>

                    <!-- Remember Me Toggle -->
                    <div class="flex items-center space-x-3">
                        <div class="relative">
                            <input
                                type="checkbox"
                                id="remember"
                                v-model="form.remember"
                                class="w-5 h-5 bg-black border border-cyan-500/50 rounded-sm checked:bg-cyan-500 checked:border-cyan-500 focus:outline-none focus:ring-1 focus:ring-cyan-500 transition-all duration-300"
                            />
                            <div class="absolute inset-0 bg-gradient-to-r from-cyan-500/20 to-pink-500/20 filter blur-md transition-opacity duration-300 opacity-0 peer-checked:opacity-100"></div>
                        </div>
                        <label for="remember" class="text-cyan-400 text-sm font-mono cursor-pointer select-none">MAINTAIN.NEURAL.LINK</label>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex items-center justify-between pt-4">
                        <Link
                            :href="route('password.request')"
                            class="text-cyan-400 text-sm hover:text-pink-400 transition-colors duration-300 font-mono relative group"
                        >
                            <span class="relative z-10">NEURAL.KEY.RESET</span>
                            <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-pink-500 transition-all duration-300 group-hover:w-full"></span>
                        </Link>

                        <button
                            type="submit"
                            :disabled="form.processing"
                            class="px-6 py-3 bg-gradient-to-r from-cyan-500 to-blue-500 text-black font-bold rounded-sm hover:from-pink-500 hover:to-purple-500 transition-all duration-500 relative overflow-hidden group disabled:opacity-50 disabled:cursor-not-allowed"
                        >
                            <span class="relative z-10">INITIALIZE ACCESS</span>
                            <div class="absolute inset-0 bg-gradient-to-r from-pink-500 to-purple-500 transition-transform duration-500 transform translate-x-full group-hover:translate-x-0"></div>
                        </button>
                    </div>

                    <!-- Register Link -->
                    <div class="text-center mt-8">
                        <Link
                            :href="route('register')"
                            class="text-cyan-400 hover:text-pink-400 transition-colors duration-300 font-mono inline-flex items-center group"
                        >
                            <span class="mr-2">&gt;</span>
                            <span>REQUEST.NEW.NEURAL.ACCESS</span>
                            <span class="ml-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300">_</span>
                        </Link>
                    </div>
                </form>
            </div>
        </div>

        <!-- Animated Scanner Effect -->
        <div class="absolute inset-0 pointer-events-none">
            <div class="scanner-line"></div>
        </div>
    </div>
</template>

<style>
/* Neural Network Animation */
.neural-paths {
    background: radial-gradient(circle at center, rgba(0,247,255,0.1) 0%, transparent 70%);
    position: absolute;
    width: 200%;
    height: 200%;
    top: -50%;
    left: -50%;
    animation: rotate 60s linear infinite;
}

/* Scanner Line Effect */
.scanner-line {
    position: absolute;
    width: 100%;
    height: 2px;
    background: linear-gradient(to right,
        transparent,
        rgba(0,247,255,0.5),
        rgba(255,0,255,0.5),
        transparent
    );
    filter: blur(1px);
    animation: scan 3s linear infinite;
}

/* Glitch Effect */
.glitch-text {
    position: relative;
    display: inline-block;
}

.glitch-text::before,
.glitch-text::after {
    content: attr(data-text);
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: black;
}

.glitch-text::before {
    left: 2px;
    text-shadow: -2px 0 #ff00ff;
    animation: glitch-1 2s infinite linear alternate-reverse;
}

.glitch-text::after {
    left: -2px;
    text-shadow: 2px 0 #00ffff;
    animation: glitch-2 3s infinite linear alternate-reverse;
}

/* Animations */
@keyframes rotate {
    from { transform: rotate(0deg); }
    to { transform: rotate(360deg); }
}

@keyframes scan {
    from { transform: translateY(-100vh); }
    to { transform: translateY(100vh); }
}

@keyframes glitch-1 {
    0% { clip-path: inset(20% 0 30% 0); }
    20% { clip-path: inset(65% 0 1% 0); }
    40% { clip-path: inset(43% 0 1% 0); }
    60% { clip-path: inset(25% 0 58% 0); }
    80% { clip-path: inset(75% 0 5% 0); }
    100% { clip-path: inset(10% 0 90% 0); }
}

@keyframes glitch-2 {
    0% { clip-path: inset(25% 0 58% 0); }
    20% { clip-path: inset(75% 0 5% 0); }
    40% { clip-path: inset(10% 0 90% 0); }
    60% { clip-path: inset(20% 0 30% 0); }
    80% { clip-path: inset(65% 0 1% 0); }
    100% { clip-path: inset(43% 0 1% 0); }
}

@keyframes text-shimmer {
    0% { background-position: -200% center; }
    100% { background-position: 200% center; }
}

@keyframes grid-float {
    0% { transform: translateY(0); }
    50% { transform: translateY(-10px); }
    100% { transform: translateY(0); }
}

/* Utility Animations */
.animate-text-shimmer {
    background-size: 200% auto;
    animation: text-shimmer 3s linear infinite;
}

.animate-pulse-slow {
    animation: pulse 4s cubic-bezier(0.4, 0, 0.6, 1) infinite;
}

.animate-grid-float {
    animation: grid-float 8s ease infinite;
}
</style>