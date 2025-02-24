<script setup>
import { ref, onMounted, onUnmounted, defineComponent } from "vue";
import { Link, router, usePage } from "@inertiajs/vue3";
import axios from "axios";
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ApplicationMark from '@/Components/ApplicationMark.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import TopNavigation from '@/Components/Navigation/TopNavigation.vue';
import SideNavigation from '@/Components/Navigation/SideNavigation.vue';

defineProps({
    title: String,
});

const showingNavigationDropdown = ref(false);

// Unread notifications
const unreadNotifications = ref(0);

const fetchUnreadNotifications = async () => {
    try {
        const response = await axios.get(route("notifications.unread-count"));
        unreadNotifications.value = response.data.unread_count;
    } catch (error) {
        console.error("Failed to fetch unread notifications", error);
    }
};

onMounted(() => {
    // Fetch unread notifications
    if (usePage().props.auth.user) {
        fetchUnreadNotifications();
    }
});

// Navigation Links Configuration
const navigationLinks = [
    {
        label: "Home",
        route: "dashboard",
    },
    {
        label: "Tweets",
        route: "tweets.index",
    },
    {
        label: "Hashtags",
        route: "hashtags.index",
    },
    {
        label: "Achievements",
        route: "achievements.index",
    },
    {
        label: "Notifications",
        route: "notifications.index",
    },
];

// User Dropdown Items
const userDropdownItems = [
    { label: "Profile", route: "profile.show" },
    { label: "Logout", route: "logout", method: "post" },
];
</script>

<template>
    <div class="min-h-screen bg-[#001122]">
        <TopNavigation 
            :user="$page.props.auth.user"
            :navigation-links="navigationLinks"
            :unread-notifications="unreadNotifications"
        />
        
        <SideNavigation :navigation-links="navigationLinks" />

        <!-- Main Content Area -->
        <div class="pl-64"> <!-- Offset for side navigation -->
            <!-- Page Heading -->
            <header v-if="$slots.header" class="bg-[#001122]/95 backdrop-blur-xl shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <slot name="header" />
                </div>
            </header>

            <!-- Page Content -->
            <main class="py-6">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <slot />
                </div>
            </main>
        </div>

        <!-- Background Effects -->
        <div class="fixed inset-0 pointer-events-none -z-10">
            <!-- Grid Effect -->
            <div class="absolute inset-0 bg-grid-neon opacity-5"></div>
            
            <!-- Glow Effects -->
            <div class="absolute top-0 left-1/4 w-96 h-96 bg-[#00FFFF]/5 rounded-full blur-[128px] animate-pulse"></div>
            <div class="absolute bottom-0 right-1/4 w-96 h-96 bg-[#FF00FF]/5 rounded-full blur-[128px] animate-pulse delay-1000"></div>
            
            <!-- Scanline Effect -->
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
