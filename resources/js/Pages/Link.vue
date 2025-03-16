<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import CreateUrl from "@/Components/Url/CreateUrl.vue";
import UrlList from "@/Components/Url/UrlList.vue";
import {computed} from "vue";
defineProps({
    url:Object
})

const toLocaleDate = (dateString) => {
    const date = new Date(Date.parse(dateString));
    return date.toLocaleDateString(undefined,{
            year: "numeric",
            month: "long",
            day: "numeric",
            minute: "numeric",
            second: "numeric",
        })
};
</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Ссылка: {{url.url_key}}
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="card mt-4">
                    <div class="flex flex-row items-center gap-4">
                        <div>
                            <p class="text-[6em] font-bold text-center -mt-4">
                                {{url.visit_count}}
                            </p>
                            <p class="text-center text-xs -mt-8">Переходов</p>
                        </div>
                        <div>
                            <p>{{url.destination_url}}</p>
                            <p>{{url.default_short_url}}</p>
                            <p>{{ toLocaleDate(url.created_at) }}</p>
                        </div>
                    </div>
<!--                    <pre>{{url.visits}}</pre>-->
                </div>

                <div v-if="url?.visits?.total > 0" class="bg-white relative overflow-x-auto shadow-md sm:rounded-lg mt-4">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                ip address
                            </th>
                            <th scope="col" class="px-6 py-3">
                                operating system
                            </th>
                            <th scope="col" class="px-6 py-3">
                                browser
                            </th>
                            <th scope="col" class="px-6 py-3">
                                referer
                            </th>
                            <th scope="col" class="px-6 py-3">
                                visited date
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="visit in url.visits.data" :key="visit.id" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ visit.ip_address }}
                            </th>
                            <td class="px-6 py-4">
                                {{ visit.device_type }}: {{ visit.operating_system }} ({{ visit.operating_system_version }})
                            </td>
                            <td class="px-6 py-4">
                                {{ visit.browser }}
                                ({{ visit.browser_version }})
                            </td>
                            <td class="px-6 py-4">
                                {{ visit.referer_url ?? 'none' }}
                            </td>
                            <td class="px-6 py-4 text-right">
                                {{ toLocaleDate(visit.visited_at) }}
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<style scoped>
.card{
    @apply bg-white dark:bg-gray-800 sm:rounded-lg p-4 shadow-sm;
}
</style>
