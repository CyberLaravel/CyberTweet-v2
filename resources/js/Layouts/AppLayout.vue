<script setup>
import { ref, onMounted, onUnmounted, defineComponent } from "vue";
import { Link, router, usePage } from "@inertiajs/vue3";
import axios from "axios";

defineProps({
    title: String,
});

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

// User Dropdown Logic
const userDropdownOpen = ref(false);
const userDropdownTrigger = ref(null);

// Dropdown Logic (consolidated)
const dropdownOpen = ref(false);
const dropdown = ref(null);

const handleClickOutside = (event) => {
    // Handle user dropdown
    if (
        userDropdownTrigger.value &&
        !userDropdownTrigger.value.contains(event.target)
    ) {
        userDropdownOpen.value = false;
    }

    // Handle other dropdowns
    if (dropdown.value && !dropdown.value.contains(event.target)) {
        dropdownOpen.value = false;
    }
};

const toggleUserDropdown = (event) => {
    event.stopPropagation();
    userDropdownOpen.value = !userDropdownOpen.value;
};

const toggleDropdown = () => {
    dropdownOpen.value = !dropdownOpen.value;
};

// Logout method
const logout = () => {
    router.post(route("logout"));
};

onMounted(() => {
    // Add click event listener to document
    document.addEventListener("click", handleClickOutside);

    // Fetch unread notifications
    if (usePage().props.auth.user) {
        fetchUnreadNotifications();
    }
});

onUnmounted(() => {
    // Remove event listener to prevent memory leaks
    document.removeEventListener("click", handleClickOutside);
});

// Quantum Navigation Links Configuration
const navigationLinks = [
    {
        label: "Home",
        route: "dashboard",
        component: "Dashboard",
        icon: defineComponent({
            template: `
                <svg fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"/>
                </svg>
            `,
        }),
    },
    {
        label: "Tweets",
        route: "tweets.index",
        component: "Tweets/Index",
        icon: defineComponent({
            template: `
                <svg fill="currentColor" viewBox="0 0 20 20">
                    <path d="M2 5a2 2 0 012-2h7a2 2 0 012 2v4a2 2 0 01-2 2H9l-3 3v-3H4a2 2 0 01-2-2V5z"/>
                    <path d="M15 7v2a4 4 0 01-4 4H9.828l-1.766 1.767c.28.149.599.233.938.233h2l3 3v-3h2a2 2 0 002-2V9a2 2 0 00-2-2h-1z"/>
                </svg>
            `,
        }),
    },
    {
        label: "Hashtags",
        route: "hashtags.index",
        component: "Hashtags/Index",
        icon: defineComponent({
            template: `
                <svg fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M9.243 3.03a1 1 0 01.727 1.213L9.53 6h2.94l.56-2.243a1 1 0 111.94.486L14.53 6H17a1 1 0 110 2h-2.97l-1 4H15a1 1 0 110 2h-2.47l-.56 2.242a1 1 0 11-1.94-.485L10.47 14H7.53l-.56 2.242a1 1 0 11-1.94-.485L5.47 14H3a1 1 0 110-2h2.97l1-4H5a1 1 0 110-2h2.47l.56-2.243a1 1 0 011.213-.727zM9.03 8l-1 4h2.938l1-4H9.031z" clip-rule="evenodd"/>
                </svg>
            `,
        }),
    },
    {
        label: "Achievements",
        route: "achievements.index",
        component: "Achievements/Index",
        icon: defineComponent({
            template: `
                <svg fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/>
                    <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"/>
                </svg>
            `,
        }),
    },
    {
        label: "Notifications",
        route: "notifications.index",
        component: "Notifications/Index",
        icon: defineComponent({
            template: `
                <svg fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z"/>
                </svg>
            `,
        }),
    },
    {
        label: "Profile",
        route: "profile.show",
        component: "Profile/Show",
        icon: defineComponent({
            template: `
                <svg fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                </svg>
            `,
        }),
    },
];

// User Dropdown Items
const userDropdownItems = [
    { label: "Profile", route: "profile.show" },
    { label: "Logout", route: "logout", method: "post" },
];
</script>

<template>
    <div
        class="min-h-screen bg-[#001133] text-white flex overflow-hidden relative"
    >
        <!-- Add cyberpunk grid overlay -->
        <div class="absolute inset-0 pointer-events-none">
            <div class="circuit-pattern"></div>
        </div>

        <!-- Update sidebar styling -->
        <div
            class="fixed left-0 top-0 bottom-0 w-72 bg-[#00113399] backdrop-blur-lg border-r border-[#00FFFF]/20 p-4 shadow-[0_0_30px_rgba(0,255,255,0.15)] quantum-container relative z-10"
        >
            <!-- Update logo styling -->
            <div class="mb-8 relative quantum-text-container">
                <Link
                    :href="route('dashboard')"
                    class="text-3xl font-orbitron font-light text-[#00FFFF] tracking-[0.15em] hover:text-[#FF00FF] transition-all duration-300 transform hover:scale-105 relative overflow-hidden group quantum-text"
                >
                    CyberTweet
                    <div class="quantum-pulse"></div>
                </Link>
            </div>

            <!-- Update navigation styling -->
            <nav class="space-y-2 mb-8 relative quantum-nav">
                <Link
                    v-for="link in navigationLinks"
                    :key="link.route"
                    :href="route(link.route)"
                    class="quantum-nav-link group"
                    :class="{
                        'quantum-nav-link-active':
                            $page.component === link.component,
                    }"
                >
                    <component
                        :is="link.icon"
                        class="w-6 h-6 mr-3 transition-all duration-300 group-hover:text-[#00FF00] quantum-icon"
                    />
                    <span class="tracking-wider quantum-text">{{
                        link.label
                    }}</span>
                    <div class="quantum-link-glitch"></div>
                </Link>
            </nav>

            <!-- Create Tweet Button - Moved below navigation -->
            <div class="px-4 mt-6">
                <Link
                    :href="route('tweets.create')"
                    class="quantum-auth-button group w-full flex justify-center"
                >
                    <span class="quantum-button-text">CREATE TWEET</span>
                    <div class="quantum-button-glitch"></div>
                    <div class="quantum-button-particles"></div>
                </Link>
            </div>

            <!-- Keep existing user profile section but update styling -->
            <div
                class="absolute bottom-0 left-0 right-0 p-4 border-t border-[#00FFFF]/10"
            >
                <div
                    ref="userDropdownTrigger"
                    v-if="$page.props.auth.user"
                    class="quantum-profile-trigger group"
                    @click="toggleUserDropdown"
                >
                    <div class="relative">
                        <img
                            :src="$page.props.auth.user.profile_photo_url"
                            class="w-12 h-12 rounded-full border-2 border-[#00FFFF]/50 group-hover:border-[#FF00FF] transition-all"
                        />
                        <div
                            class="absolute -bottom-1 -right-1 w-3 h-3 bg-[#00FF00] rounded-full animate-ping"
                        ></div>
                    </div>
                    <div class="ml-3 flex-grow">
                        <div
                            class="font-orbitron text-[#00FFFF] group-hover:text-[#FF00FF] transition-colors"
                        >
                            {{ $page.props.auth.user.name }}
                        </div>
                        <div class="text-sm text-[#00FFFF]/70">
                            @{{ $page.props.auth.user.username }}
                        </div>
                    </div>
                    <svg
                        class="w-6 h-6 text-[#00FFFF] group-hover:text-[#FF00FF] transition-colors"
                        fill="currentColor"
                        viewBox="0 0 20 20"
                    >
                        <path
                            fill-rule="evenodd"
                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                            clip-rule="evenodd"
                        />
                    </svg>
                </div>

                <!-- Quantum Dropdown -->
                <transition
                    enter-active-class="transition ease-out duration-200"
                    enter-from-class="transform opacity-0 scale-90"
                    enter-to-class="transform opacity-100 scale-100"
                    leave-active-class="transition ease-in duration-150"
                    leave-from-class="transform opacity-100 scale-100"
                    leave-to-class="transform opacity-0 scale-90"
                >
                    <div
                        v-if="userDropdownOpen"
                        class="absolute bottom-full left-0 right-0 mb-2 bg-[#001133] border border-[#00FFFF]/20 rounded-lg shadow-quantum z-50"
                    >
                        <Link
                            v-for="item in userDropdownItems"
                            :key="item.label"
                            :href="route(item.route)"
                            :method="item.method || 'get'"
                            class="block px-4 py-2 text-[#00FFFF] hover:bg-[#00FFFF]/10 hover:text-[#FF00FF] transition-colors"
                        >
                            {{ item.label }}
                        </Link>
                    </div>
                </transition>
            </div>
        </div>

        <!-- Main Content Area -->
        <div class="ml-72 flex-1 bg-[#001133] relative">
            <!-- Cyberpunk Background Effect -->
            <div
                class="absolute inset-0 bg-grid-pattern opacity-10 pointer-events-none z-0"
            ></div>

            <!-- Top Navbar with Quantum Aesthetic -->
            <nav
                class="sticky top-0 z-10 bg-[#00113399] backdrop-blur-md p-4 flex justify-between items-center border-b border-[#00FFFF]/20"
            >
                <h1
                    class="text-2xl font-orbitron font-light text-[#00FFFF] tracking-wider"
                >
                    {{ $page.props.title || "Dashboard" }}
                </h1>

                <div class="flex items-center space-x-4">
                    <!-- Quantum Search Bar -->
                    <div class="relative">
                        <input
                            type="text"
                            placeholder="Search CyberTweet"
                            class="bg-[#00113399] text-[#00FFFF] px-4 py-2 rounded-full w-64 border border-[#00FFFF]/20 focus:border-[#FF00FF] transition-all duration-300"
                        />
                        <svg
                            class="absolute right-3 top-3 w-5 h-5 text-[#00FFFF]/50"
                            fill="currentColor"
                            viewBox="0 0 20 20"
                        >
                            <path
                                fill-rule="evenodd"
                                d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                clip-rule="evenodd"
                            />
                        </svg>
                    </div>
                </div>
            </nav>

            <!-- Page Content with Quantum Overlay -->
            <main
                class="p-6 relative z-10 before:absolute before:inset-0 before:bg-grid-pattern before:opacity-10 before:pointer-events-none"
            >
                <slot />
            </main>
        </div>
    </div>
</template>

<style>
/* Cyberpunk Grid Background Pattern */
.bg-grid-pattern {
    background-image: linear-gradient(
            to right,
            rgba(0, 255, 255, 0.1) 1px,
            transparent 1px
        ),
        linear-gradient(to bottom, rgba(0, 255, 255, 0.1) 1px, transparent 1px);
    background-size: 20px 20px;
}

/* Existing quantum styles remain the same */
.quantum-auth-button {
    @apply relative h-[60px] bg-[#00113399] border-2 border-[#00FFFF] 
           rounded-[8px] flex items-center justify-center 
           overflow-hidden transition-all duration-300 
           hover:border-[#FF00FF] hover:bg-[#FF00FF]/10;
}

.quantum-button-text {
    @apply text-[#FFFFFF] font-orbitron font-light 
           uppercase tracking-wider z-10 relative 
           group-hover:text-[#00FF00] transition-colors;
    text-shadow: 0 0 5px rgba(0, 255, 255, 0.5);
}

.quantum-button-glitch {
    @apply absolute inset-0 opacity-0 group-hover:opacity-20 
           pointer-events-none;
    background: linear-gradient(45deg, #00ffff, #ff00ff);
    mix-blend-mode: color-dodge;
    animation: glitch-animation 0.3s infinite alternate;
}

@keyframes glitch-animation {
    0% {
        transform: translate(0, 0);
    }
    50% {
        transform: translate(-2px, 2px);
    }
    100% {
        transform: translate(2px, -2px);
    }
}

.quantum-auth-button:hover {
    box-shadow: 0 0 10px rgba(0, 255, 255, 0.5), 0 0 20px rgba(255, 0, 255, 0.3);
}

.quantum-nav-link {
    @apply flex items-center relative px-4 py-2 rounded-lg text-[#00FFFF]/70 hover:bg-[#00FFFF]/10 transition-all duration-300 overflow-hidden;
}

.quantum-nav-link-active {
    @apply bg-[#00FFFF]/20 text-[#00FFFF] font-bold;
}

.quantum-profile-trigger {
    @apply flex items-center cursor-pointer p-2 rounded-lg hover:bg-[#00FFFF]/10 transition-all duration-300;
}

.nav-link-glitch {
    background: linear-gradient(45deg, #00ffff, #ff00ff);
    mix-blend-mode: color-dodge;
    pointer-events: none;
}

.shadow-quantum {
    box-shadow: 0 0 10px rgba(0, 255, 255, 0.2), 0 0 20px rgba(255, 0, 255, 0.1);
}

.quantum-container {
    position: relative;
    &::before {
        content: "";
        position: absolute;
        inset: 0;
        background: linear-gradient(45deg, #00ffff05, #ff00ff05);
        mask-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M54.627 0l.83.828-1.415 1.415L51.8 0h2.827zM5.373 0l-.83.828L5.96 2.243 8.2 0H5.374zM48.97 0l3.657 3.657-1.414 1.414L46.143 0h2.828zM11.03 0L7.372 3.657 8.787 5.07 13.857 0H11.03zm32.284 0L49.8 6.485 48.384 7.9l-7.9-7.9h2.83zM16.686 0L10.2 6.485 11.616 7.9l7.9-7.9h-2.83zM22.344 0L13.858 8.485 15.272 9.9l7.9-7.9h-.828zm5.656 0L19.515 8.485 17.343 10.657 28 0h-2.83zM32.656 0L26.172 6.485 24 8.657 34.657 0h-2zm5.657 0L30.828 7.485 28.656 9.657 39.313 0h-2zM44.97 0L38.485 6.485 36.313 8.657 46.97 0h-2zM0 47.172l8.485-8.485 1.415 1.414L0 50.343v-3.17zm0 5.656l8.485-8.485 1.415 1.415L0 56v-3.172zM0 41.515L8.485 33.03 9.9 34.444 0 44.343v-2.828zm0 5.657l8.485-8.485 1.414 1.415L0 50v-2.828zm0-11.313L8.485 27.374 9.9 28.788 0 38.687v-2.83zm0 5.656l8.485-8.485 1.414 1.414L0 44.344v-2.83zm0-11.313L8.485 21.717 9.9 23.131 0 33.03v-2.83zm0 5.657L8.485 21.717 9.9 23.131 0 33.03v-2.83zM0 0l8.485 8.485-1.414 1.414L0 2.828V0zm0 5.657l8.485 8.485-1.414 1.414L0 8.485V5.657zm0 5.657l8.485 8.485-1.414 1.414L0 14.142v-2.828zm0 5.657l8.485 8.485-1.414 1.414L0 19.8v-2.83zm0 5.657l8.485 8.485-1.414 1.414L0 25.456v-2.83zm0 5.657l8.485 8.485-1.414 1.414L0 31.113v-2.83zm0 5.657l8.485 8.485-1.414 1.414L0 36.77v-2.83zm0 5.657l8.485 8.485-1.414 1.414L0 42.427v-2.83zm0 5.657l8.485 8.485-1.414 1.414L0 48.084v-2.83zm0 5.657l8.485 8.485-1.414 1.414L0 53.74v-2.83zM54.627 60L60 54.627v2.83L57.172 60h-2.545zm-5.656 0L60 48.97v2.83L51.544 60h-2.573zm-5.657 0L60 43.314v2.83L45.887 60h-2.573zm-5.657 0L60 37.657v2.83L40.23 60h-2.573zm-5.657 0L60 32v2.828L34.573 60h-2.573zm-5.657 0L60 26.344v2.83L28.916 60h-2.573zm-5.657 0L60 20.687v2.83L23.26 60h-2.574zm-5.657 0L60 15.03v2.83L17.602 60h-2.573zm-5.657 0L60 9.373v2.83L11.945 60H9.372zm-5.657 0L60 3.716v2.83L6.288 60H3.715z' fill='%2300FFFF' fill-opacity='0.1' fill-rule='evenodd'/%3E%3C/svg%3E");
    }
}

.quantum-pulse {
    @apply absolute -top-2 -right-2 w-4 h-4 bg-[#FF00FF] rounded-full;
    animation: quantum-pulse 2s infinite;
}

.quantum-link-glitch {
    @apply absolute inset-0 opacity-0 group-hover:opacity-20;
    background: linear-gradient(45deg, #00ffff, #ff00ff);
    mix-blend-mode: color-dodge;
    animation: glitch-animation 0.3s infinite alternate;
}

.quantum-button-particles {
    @apply absolute inset-0 opacity-0 group-hover:opacity-30;
    background-image: radial-gradient(circle, #00ffff 1px, transparent 1px);
    background-size: 10px 10px;
    animation: particle-flow 2s linear infinite;
}

@keyframes quantum-pulse {
    0% {
        transform: scale(1);
        opacity: 0.5;
    }
    50% {
        transform: scale(1.5);
        opacity: 0.2;
    }
    100% {
        transform: scale(1);
        opacity: 0.5;
    }
}

@keyframes particle-flow {
    0% {
        background-position: 0 0;
    }
    100% {
        background-position: 20px 20px;
    }
}
</style>
