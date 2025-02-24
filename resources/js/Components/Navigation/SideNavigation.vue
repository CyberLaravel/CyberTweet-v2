<script setup>
import { defineComponent } from 'vue';
import { Link } from '@inertiajs/vue3';

const navigationLinks = [
    {
        label: "Home",
        route: "dashboard",
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
        icon: defineComponent({
            template: `
                <svg fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M9.243 3.03a1 1 0 01.727 1.213L9.53 6h2.94l.56-2.243a1 1 0 111.94.486L14.53 6H17a1 1 0 110 2h-2.97l-1 4H15a1 1 0 110 2h-2.47l-.56 2.242a1 1 0 11-1.94-.485L10.47 14H7.53l-.56 2.242a1 1 0 11-1.94-.485L5.47 14H3a1 1 0 110-2h2.97l1-4H5a1 1 0 110-2h2.47l.56-2.243a1 1 0 011.213-.727zM9.03 8l-1 4h2.938l1-4H9.031z"/>
                </svg>
            `,
        }),
    },
    {
        label: "Achievements",
        route: "achievements.index",
        icon: defineComponent({
            template: `
                <svg fill="currentColor" viewBox="0 0 20 20">
                    <path d="M5 4a2 2 0 012-2h6a2 2 0 012 2v14l-5-2.5L5 18V4z"/>
                </svg>
            `,
        }),
    },
    {
        label: "Notifications",
        route: "notifications.index",
        icon: defineComponent({
            template: `
                <svg fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zm0 16a3 3 0 01-3-3h6a3 3 0 01-3 3z"/>
                </svg>
            `,
        }),
    },
];
</script>

<template>
    <div class="fixed left-0 top-0 bottom-0 w-64 bg-[#001122]/95 backdrop-blur-xl border-r border-[#00FFFF]/20 p-4 pt-20">
        <div class="space-y-2">
            <div v-for="link in navigationLinks" :key="link.route" class="group">
                <Link 
                    :href="route(link.route)"
                    class="flex items-center space-x-3 px-4 py-3 rounded-lg transition-all duration-300"
                    :class="{
                        'bg-[#00FFFF]/10 text-[#00FFFF]': route().current(link.route),
                        'text-[#00FFFF]/60 hover:text-[#00FFFF] hover:bg-[#00FFFF]/5': !route().current(link.route)
                    }"
                >
                    <component 
                        :is="link.icon" 
                        class="w-5 h-5"
                    />
                    <span>{{ link.label }}</span>
                </Link>
            </div>
        </div>
    </div>
</template> 