<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import CreateUrl from "@/Components/Url/CreateUrl.vue";
import UrlList from "@/Components/Url/UrlList.vue";
defineProps({
    urls:Array
})
</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="card">
                    <create-url/>
                </div>
                <div class="card mt-4">
                    <url-list :urls="urls"/>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<style scoped>
.card{
    @apply bg-white dark:bg-gray-800 overflow-hidden sm:rounded-lg p-4 shadow-sm;
}
</style>
