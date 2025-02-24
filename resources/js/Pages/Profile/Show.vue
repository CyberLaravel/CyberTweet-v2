<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import DeleteUserForm from '@/Pages/Profile/Partials/DeleteUserForm.vue';
import LogoutOtherBrowserSessionsForm from '@/Pages/Profile/Partials/LogoutOtherBrowserSessionsForm.vue';
import SectionBorder from '@/Components/SectionBorder.vue';
import TwoFactorAuthenticationForm from '@/Pages/Profile/Partials/TwoFactorAuthenticationForm.vue';
import UpdatePasswordForm from '@/Pages/Profile/Partials/UpdatePasswordForm.vue';
import UpdateProfileInformationForm from '@/Pages/Profile/Partials/UpdateProfileInformationForm.vue';

defineProps({
    confirmsTwoFactorAuthentication: Boolean,
    sessions: Array,
});
</script>

<template>
    <AppLayout title="Neural Profile">
        <template #header>
            <h2 class="font-['Orbitron'] text-xl text-[#00FFFF] leading-tight tracking-wider">
                NEURAL PROFILE <span class="text-[#FF00FF]">INTERFACE</span>
            </h2>
        </template>

        <div class="relative">
            <!-- Background Effects -->
            <div class="absolute inset-0 bg-grid-neon opacity-5 pointer-events-none"></div>
            <div class="absolute top-0 left-1/4 w-96 h-96 bg-[#00FFFF]/5 rounded-full blur-[128px] animate-pulse pointer-events-none"></div>
            <div class="absolute bottom-0 right-1/4 w-96 h-96 bg-[#FF00FF]/5 rounded-full blur-[128px] animate-pulse delay-1000 pointer-events-none"></div>

            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8 space-y-6">
                <!-- Profile Section -->
                <div v-if="$page.props.jetstream.canUpdateProfileInformation" class="relative">
                    <!-- Neon Border Effect -->
                    <div class="absolute -inset-[1px] bg-gradient-to-r from-[#00FFFF] via-[#FF00FF] to-[#00FFFF] rounded-lg opacity-30 blur"></div>
                    
                    <div class="relative bg-[#001122]/95 backdrop-blur-xl border border-[#00FFFF]/20 rounded-lg shadow-[0_0_50px_rgba(0,255,255,0.1)]">
                        <UpdateProfileInformationForm :user="$page.props.auth.user" />
                    </div>
                </div>

                <!-- Password Section -->
                <div v-if="$page.props.jetstream.canUpdatePassword" class="relative mt-10 sm:mt-0">
                    <!-- Neon Border Effect -->
                    <div class="absolute -inset-[1px] bg-gradient-to-r from-[#00FFFF] via-[#FF00FF] to-[#00FFFF] rounded-lg opacity-30 blur"></div>
                    
                    <div class="relative bg-[#001122]/95 backdrop-blur-xl border border-[#00FFFF]/20 rounded-lg shadow-[0_0_50px_rgba(0,255,255,0.1)]">
                        <UpdatePasswordForm />
                    </div>
                </div>

                <!-- Two Factor Authentication -->
                <div v-if="$page.props.jetstream.canManageTwoFactorAuthentication" class="relative mt-10 sm:mt-0">
                    <!-- Neon Border Effect -->
                    <div class="absolute -inset-[1px] bg-gradient-to-r from-[#00FFFF] via-[#FF00FF] to-[#00FFFF] rounded-lg opacity-30 blur"></div>
                    
                    <div class="relative bg-[#001122]/95 backdrop-blur-xl border border-[#00FFFF]/20 rounded-lg shadow-[0_0_50px_rgba(0,255,255,0.1)]">
                        <TwoFactorAuthenticationForm :requires-confirmation="confirmsTwoFactorAuthentication" />
                    </div>
                </div>

                <!-- Browser Sessions -->
                <div class="relative mt-10 sm:mt-0">
                    <!-- Neon Border Effect -->
                    <div class="absolute -inset-[1px] bg-gradient-to-r from-[#00FFFF] via-[#FF00FF] to-[#00FFFF] rounded-lg opacity-30 blur"></div>
                    
                    <div class="relative bg-[#001122]/95 backdrop-blur-xl border border-[#00FFFF]/20 rounded-lg shadow-[0_0_50px_rgba(0,255,255,0.1)]">
                        <LogoutOtherBrowserSessionsForm :sessions="sessions" />
                    </div>
                </div>

                <!-- Delete Account -->
                <div v-if="$page.props.jetstream.hasAccountDeletionFeatures" class="relative mt-10 sm:mt-0">
                    <!-- Neon Border Effect -->
                    <div class="absolute -inset-[1px] bg-gradient-to-r from-[#00FFFF] via-[#FF00FF] to-[#00FFFF] rounded-lg opacity-30 blur"></div>
                    
                    <div class="relative bg-[#001122]/95 backdrop-blur-xl border border-[#00FFFF]/20 rounded-lg shadow-[0_0_50px_rgba(0,255,255,0.1)]">
                        <DeleteUserForm />
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
