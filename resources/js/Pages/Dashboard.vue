<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Welcome from '@/Components/Welcome.vue';
</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-['Orbitron'] text-xl text-[#00FFFF] leading-tight tracking-wider">
                NEURAL <span class="text-[#FF00FF]">DASHBOARD</span>
            </h2>
        </template>

        <div class="relative py-12">
            <!-- Background Effects -->
            <div class="absolute inset-0 bg-grid-neon opacity-5 pointer-events-none"></div>
            <div class="absolute top-0 left-1/4 w-96 h-96 bg-[#00FFFF]/5 rounded-full blur-[128px] animate-pulse pointer-events-none"></div>
            <div class="absolute bottom-0 right-1/4 w-96 h-96 bg-[#FF00FF]/5 rounded-full blur-[128px] animate-pulse delay-1000 pointer-events-none"></div>

            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="relative">
                    <!-- Neon Border Effect -->
                    <div class="absolute -inset-[1px] bg-gradient-to-r from-[#00FFFF] via-[#FF00FF] to-[#00FFFF] rounded-lg opacity-30 blur"></div>
                    
                    <div class="relative bg-[#001122]/95 backdrop-blur-xl border border-[#00FFFF]/20 overflow-hidden shadow-[0_0_50px_rgba(0,255,255,0.1)] sm:rounded-lg">
                        <Welcome />
                    </div>
                </div>
            </div>

            <!-- Scanline Effect -->
            <div class="pointer-events-none fixed inset-0">
                <div class="absolute inset-0 bg-[linear-gradient(to_bottom,transparent_50%,rgba(0,255,255,0.1)_50%)] bg-[length:100%_4px] animate-scanline"></div>
            </div>
        </div>
    </AppLayout>
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
