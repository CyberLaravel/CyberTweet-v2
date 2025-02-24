<script setup>
import { ref } from 'vue';
import { Link, router } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import TweetList from '@/Components/TweetList.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';

const props = defineProps({
    profile: Object,
    tweets: Object,
    stats: Object,
    isFollowing: Boolean,
});

const isLoading = ref(false);

const followUser = async () => {
    isLoading.value = true;
    try {
        await router.post(route('users.follow', props.profile.data.username));
    } catch (error) {
        console.error('Failed to follow user:', error);
    } finally {
        isLoading.value = false;
    }
};
</script>

<template>
    <AppLayout :title="profile.data.name">
        <template #header>
            <h2 class="font-semibold text-xl text-[#00FFFF] leading-tight">
                Profile
            </h2>
        </template>

        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            <!-- Profile Header -->
            <div class="bg-[#001122]/95 backdrop-blur-xl border border-[#00FFFF]/20 rounded-lg p-6 mb-6">
                <div class="flex items-start justify-between">
                    <div class="flex items-center space-x-5">
                        <img 
                            :src="profile.data.profile_photo_url" 
                            :alt="profile.data.name"
                            class="w-24 h-24 rounded-full border-2 border-[#00FFFF]/20"
                        >
                        <div>
                            <h1 class="text-2xl font-bold text-[#00FFFF]">{{ profile.data.name }}</h1>
                            <p class="text-[#00FFFF]/60">@{{ profile.data.username }}</p>
                            <p v-if="profile.data.bio" class="mt-2 text-[#00FFFF]/80">
                                {{ profile.data.bio }}
                            </p>
                        </div>
                    </div>

                    <div v-if="profile.data.id !== $page.props.auth.user.id">
                        <PrimaryButton 
                            @click="followUser"
                            :disabled="isLoading"
                            :class="{ 
                                'bg-[#FF00FF]/10 border-[#FF00FF]/20 text-[#FF00FF]': isFollowing,
                                'opacity-50 cursor-not-allowed': isLoading 
                            }"
                        >
                            {{ isFollowing ? 'Unfollow' : 'Follow' }}
                        </PrimaryButton>
                    </div>
                </div>

                <!-- Stats -->
                <div class="flex space-x-8 mt-6">
                    <div>
                        <span class="text-[#00FFFF] font-bold">{{ stats.tweets }}</span>
                        <span class="text-[#00FFFF]/60 ml-1">Tweets</span>
                    </div>
                    <div>
                        <span class="text-[#00FFFF] font-bold">{{ stats.followers }}</span>
                        <span class="text-[#00FFFF]/60 ml-1">Followers</span>
                    </div>
                    <div>
                        <span class="text-[#00FFFF] font-bold">{{ stats.following }}</span>
                        <span class="text-[#00FFFF]/60 ml-1">Following</span>
                    </div>
                </div>
            </div>

            <!-- Tweets -->
            <div v-if="tweets.data.length > 0">
                <TweetList :tweets="tweets" />
            </div>
            <div v-else class="text-center py-10 text-[#00FFFF]/60">
                No tweets yet
            </div>
        </div>
    </AppLayout>
</template> 