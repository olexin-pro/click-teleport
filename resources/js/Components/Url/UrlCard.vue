<script setup>
import {computed, ref} from "vue";
import Popover from "@/Components/Popover.vue";

import {ClipboardDocumentIcon, ClipboardDocumentCheckIcon} from '@heroicons/vue/24/outline'
import {ArrowTopRightOnSquareIcon, ClipboardIcon} from '@heroicons/vue/24/solid'
import Toast from "@/Components/Toast.vue";
import QRCodeLink from "@/Components/Url/QRCodeLink.vue";
import NavLink from "@/Components/NavLink.vue";

const props = defineProps({
    url: Object
})

const toastIsShow = ref(false)
const copied = ref(false)

const date = computed(() => (new Date(Date.parse(props.url.created_at)))
    .toLocaleDateString(undefined,{
        year: "numeric",
        month: "numeric",
        day: "numeric",
    }));

function copyToClipboard() {

    navigator.clipboard.writeText(props.url.default_short_url)
        .then(() => {
            runToast()
            copyCheck()
        })
        .catch((error) => {
            console.error("Не удалось скопировать ссылку: ", error);
        });
}

const runToast = () => {
    toastIsShow.value = true;
    setTimeout(() => {
        toastIsShow.value = false;
    }, 3000);
};

const copyCheck = () => {
    copied.value = true;
    setTimeout(() => {
        copied.value = false;
    }, 1500);
};
</script>

<template>
    <div class="border max-w-full rounded-lg p-3 grid grid-cols-12 items-center gap-2">
        <q-r-code-link  class="col-span-1 md:col-span-2" :url-key="url.url_key"/>
        <div class="col-span-11 md:col-span-10">
            <h4 class="font-bold text-sm md:text-base w-full max-w-full overflow-x-hidden whitespace-nowrap">
                <a href="#" @click.prevent="copyToClipboard">
                    <ClipboardDocumentIcon v-if="!copied"
                        class="size-4 inline"
                    />
                    <ClipboardDocumentCheckIcon v-else
                        class="size-4 inline"
                    />
                </a>
                <a :href="url.default_short_url" target="_blank">
                    <ArrowTopRightOnSquareIcon
                        class="size-4 inline"
                    />
                </a>
                <NavLink :href="route('dashboard.url.show', url.url_key)" class="whitespace-nowrap overflow-x-hidden pl-2">
                    {{ url.default_short_url }}
                </NavLink>
            </h4>
            <div class="text-xs md:text-sm w-full max-w-full overflow-x-hidden whitespace-nowrap">
                <span>{{ date }}</span>
                <span class="px-1">|</span>
                <a target="_blank" :href="url.destination_url" class="max-w-xs">{{ url.destination_url }}</a>
            </div>
        </div>
        <toast v-model="toastIsShow" message="Ссылка скопирована в буфер обмена!">
            <template #icon>
                <ClipboardIcon
                    class="h-6 w-6 text-white"
                    aria-hidden="true"
                />
            </template>
        </toast>
    </div>

</template>

<style scoped>

</style>
