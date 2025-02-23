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
    <Head title="Email Verification" />

    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-black relative overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-br from-black to-gray-900 opacity-90 pointer-events-none"></div>
        <div class="absolute inset-0 bg-[length:50px_50px] opacity-10 bg-[linear-gradient(90deg,rgba(0,255,255,0.1)_1px,transparent_1px),linear-gradient(rgba(0,255,255,0.1)_1px,transparent_1px)] pointer-events-none"></div>

        <div class="w-full sm:max-w-md mt-6 px-6 py-8 bg-black/80 border border-cyan-500/30 shadow-2xl shadow-cyan-500/20 relative z-10">
            <div class="text-center mb-8">
                <h1 class="text-4xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-cyan-500 to-pink-500 animate-pulse">
                    CYBER<span class="text-pink-500">TWEET</span>
                </h1>
            </div>

            <div class="mb-4 text-sm text-cyan-500">
                Before continuing, could you verify your email address by clicking on the link we just emailed to you? If you didn't receive the email, we will gladly send you another.
            </div>

            <div v-if="verificationLinkSent" class="mb-4 text-sm text-green-500 bg-black/50 border border-green-500/30 p-3">
                A new verification link has been sent to the email address you provided in your profile settings.
            </div>

            <form @submit.prevent="submit" class="space-y-6">
                <div class="flex items-center justify-between">
                    <button 
                        type="submit" 
                        :disabled="form.processing"
                        class="px-4 py-2 bg-gradient-to-r from-cyan-500 to-pink-500 
                               text-black font-bold uppercase 
                               hover:from-cyan-600 hover:to-pink-600 
                               focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:ring-offset-2 
                               transition duration-300 
                               disabled:opacity-50"
                    >
                        Resend Verification Email
                    </button>

                    <div class="space-x-4">
                        <Link
                            :href="route('profile.show')"
                            class="text-sm text-cyan-500 hover:text-pink-500 transition duration-300"
                        >
                            Edit Profile
                        </Link>

                        <Link
                            :href="route('logout')"
                            method="post"
                            as="button"
                            class="text-sm text-cyan-500 hover:text-pink-500 transition duration-300"
                        >
                            Log Out
                        </Link>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>
