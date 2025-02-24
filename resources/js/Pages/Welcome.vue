<script setup>
import { Head, Link } from '@inertiajs/vue3';

const props = defineProps({
    canLogin: {
        type: Boolean,
        default: false
    },
    canRegister: {
        type: Boolean,
        default: false
    },
    laravelVersion: {
        type: String,
        required: true
    },
    phpVersion: {
        type: String,
        required: true
    }
});

const features = [
    {
        title: "Neural Network",
        description: "Connect with like-minded individuals in our cyberpunk community."
    },
    {
        title: "Quantum Encryption",
        description: "Your thoughts are secured with state-of-the-art protection."
    },
    {
        title: "Digital Identity",
        description: "Create and customize your unique digital presence."
    },
    {
        title: "Neural Feed",
        description: "Experience a personalized stream of consciousness."
    },
    {
        title: "Cyber Achievements",
        description: "Earn recognition for your digital contributions."
    },
    {
        title: "Holographic Tags",
        description: "Organize content with our advanced tagging system."
    }
];
</script>

<template>
    <Head title="Welcome" />
    
    <div class="relative min-h-screen bg-[#001122]">
        <!-- Background Effects -->
        <div class="absolute inset-0 bg-grid-neon opacity-5"></div>
        <div class="absolute top-0 left-1/4 w-96 h-96 bg-[#00FFFF]/5 rounded-full blur-[128px] animate-pulse"></div>
        <div class="absolute bottom-0 right-1/4 w-96 h-96 bg-[#FF00FF]/5 rounded-full blur-[128px] animate-pulse delay-1000"></div>

        <!-- Navigation -->
        <div class="relative">
            <nav v-if="canLogin" class="fixed top-0 right-0 px-6 py-4 z-50">
                <template v-if="$page.props.auth.user">
                    <Link 
                        :href="route('dashboard')"
                        class="font-['Orbitron'] text-[#00FFFF] hover:text-[#FF00FF] transition-colors duration-300"
                    >
                        Dashboard
                    </Link>
                </template>
                <template v-else>
                    <Link 
                        :href="route('login')"
                        class="font-['Orbitron'] text-[#00FFFF] hover:text-[#FF00FF] transition-colors duration-300"
                    >
                        Log in
                    </Link>

                    <Link 
                        v-if="canRegister" 
                        :href="route('register')"
                        class="font-['Orbitron'] ml-4 text-[#00FFFF] hover:text-[#FF00FF] transition-colors duration-300"
                    >
                        Register
                    </Link>
                </template>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="relative min-h-screen flex flex-col items-center justify-center px-6">
            <!-- Logo -->
            <div class="text-center mb-12 animate-fade-in">
                <h1 class="font-['Orbitron'] text-6xl font-light tracking-wider mb-4 animate-glow">
                    <span class="text-[#00FFFF] hover:text-[#FF00FF] transition-colors duration-300">Cyber</span>
                    <span class="text-[#FF00FF] hover:text-[#00FFFF] transition-colors duration-300">Tweet</span>
                </h1>
                <p class="text-[#00FFFF]/60 text-xl">
                    The Future of Social Connection
                </p>
            </div>

            <!-- Features Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 max-w-7xl mx-auto">
                <div v-for="(feature, index) in features" 
                    :key="index" 
                    class="relative group transform hover:scale-105 transition-all duration-300"
                    :style="{ 'animation-delay': `${index * 100}ms` }"
                >
                    <div class="absolute -inset-[1px] bg-gradient-to-r from-[#00FFFF] via-[#FF00FF] to-[#00FFFF] rounded-lg opacity-30 blur group-hover:opacity-50 transition-opacity"></div>
                    <div class="relative bg-[#001122]/95 backdrop-blur-xl border border-[#00FFFF]/20 p-6 rounded-lg">
                        <h3 class="font-['Orbitron'] text-[#00FFFF] text-xl mb-3">{{ feature.title }}</h3>
                        <p class="text-[#00FFFF]/60">{{ feature.description }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer class="absolute bottom-0 w-full py-4 text-center text-[#00FFFF]/40">
            Laravel v{{ laravelVersion }} (PHP v{{ phpVersion }})
        </footer>

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

@keyframes fade-in {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}

@keyframes glow {
    0%, 100% { text-shadow: 0 0 20px rgba(0, 255, 255, 0.5); }
    50% { text-shadow: 0 0 40px rgba(255, 0, 255, 0.5); }
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

.animate-fade-in {
    animation: fade-in 1s ease-out forwards;
}

.animate-glow {
    animation: glow 3s ease-in-out infinite;
}

.grid > div {
    animation: fade-in 0.5s ease-out forwards;
    opacity: 0;
}
</style>
