<script setup>
import { ref } from 'vue';
import { Link, router } from '@inertiajs/vue3';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import ApplicationMark from '@/Components/ApplicationMark.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';

const props = defineProps({
    user: {
        type: Object,
        required: true
    },
    navigationLinks: {
        type: Array,
        required: true
    },
    unreadNotifications: {
        type: Number,
        default: 0
    }
});

const showingNavigationDropdown = ref(false);

const userDropdownItems = [
    { label: "Profile", route: "profile.show" },
];

const logout = () => {
    router.post(route('logout'));
};
</script>

<template>
    <nav class="fixed top-0 left-0 right-0 z-50 border-b border-[#00FFFF]/20 bg-[#001122]/95 backdrop-blur-xl">
        <!-- Primary Navigation Menu -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <!-- Logo -->
                    <div class="shrink-0 flex items-center">
                        <Link :href="route('dashboard')" class="group">
                            <ApplicationMark class="block h-9 w-auto" />
                        </Link>
                    </div>
                </div>

                <!-- Settings Dropdown -->
                <div class="hidden sm:flex sm:items-center sm:ml-6">
                    <div class="ml-3 relative">
                        <Dropdown align="right" width="48">
                            <template #trigger>
                                <button class="flex items-center space-x-3 text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-[#00FFFF] transition">
                                    <img 
                                        class="h-8 w-8 rounded-full object-cover border border-[#00FFFF]/20" 
                                        :src="user.profile_photo_url" 
                                        :alt="user.name"
                                    >
                                    <span class="text-[#00FFFF]/60 hover:text-[#00FFFF]">{{ user.name }}</span>
                                </button>
                            </template>

                            <template #content>
                                <!-- Account Management -->
                                <div class="block px-4 py-2 text-xs text-[#00FFFF]/60 uppercase tracking-wider">
                                    Manage Account
                                </div>

                                <DropdownLink 
                                    v-for="item in userDropdownItems" 
                                    :key="item.route"
                                    :href="route(item.route)"
                                >
                                    {{ item.label }}
                                </DropdownLink>

                                <div class="border-t border-[#00FFFF]/10 my-1"></div>

                                <!-- Authentication -->
                                <form @submit.prevent="logout">
                                    <DropdownLink as="button">
                                        Log Out
                                    </DropdownLink>
                                </form>
                            </template>
                        </Dropdown>
                    </div>
                </div>

                <!-- Hamburger -->
                <div class="-mr-2 flex items-center sm:hidden">
                    <button 
                        @click="showingNavigationDropdown = !showingNavigationDropdown"
                        class="inline-flex items-center justify-center p-2 rounded-md text-[#00FFFF]/60 hover:text-[#00FFFF] hover:bg-[#00FFFF]/10 focus:outline-none transition duration-150 ease-in-out"
                    >
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path 
                                :class="{'hidden': showingNavigationDropdown, 'inline-flex': !showingNavigationDropdown }"
                                stroke-linecap="round" 
                                stroke-linejoin="round" 
                                stroke-width="2" 
                                d="M4 6h16M4 12h16M4 18h16"
                            />
                            <path 
                                :class="{'hidden': !showingNavigationDropdown, 'inline-flex': showingNavigationDropdown }"
                                stroke-linecap="round" 
                                stroke-linejoin="round" 
                                stroke-width="2" 
                                d="M6 18L18 6M6 6l12 12"
                            />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Responsive Navigation Menu -->
        <div :class="{'block': showingNavigationDropdown, 'hidden': !showingNavigationDropdown}" class="sm:hidden">
            <div class="pt-2 pb-3 space-y-1">
                <ResponsiveNavLink 
                    v-for="link in navigationLinks" 
                    :key="link.route"
                    :href="route(link.route)"
                    :active="route().current(link.route)"
                >
                    {{ link.label }}
                </ResponsiveNavLink>
            </div>

            <!-- Responsive Settings Options -->
            <div class="pt-4 pb-1 border-t border-[#00FFFF]/10">
                <div class="flex items-center px-4">
                    <div class="flex-shrink-0">
                        <img 
                            class="h-10 w-10 rounded-full object-cover border border-[#00FFFF]/20" 
                            :src="user.profile_photo_url" 
                            :alt="user.name"
                        >
                    </div>

                    <div class="ml-3">
                        <div class="font-medium text-base text-[#00FFFF]">
                            {{ user.name }}
                        </div>
                        <div class="font-medium text-sm text-[#00FFFF]/60">
                            {{ user.email }}
                        </div>
                    </div>
                </div>

                <div class="mt-3 space-y-1">
                    <ResponsiveNavLink :href="route('profile.show')">
                        Profile
                    </ResponsiveNavLink>

                    <!-- Authentication -->
                    <form method="POST" @submit.prevent="logout">
                        <ResponsiveNavLink as="button">
                            Log Out
                        </ResponsiveNavLink>
                    </form>
                </div>
            </div>
        </div>
    </nav>
</template> 