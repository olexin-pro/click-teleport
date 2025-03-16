<script setup>
import Popover from "@/Components/Popover.vue";
import {ClipboardIcon, QrCodeIcon} from "@heroicons/vue/20/solid/index.js";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import {ArrowDownOnSquareStackIcon} from '@heroicons/vue/20/solid'
import {computed, ref} from "vue";
import Toast from "@/Components/Toast.vue";
const props = defineProps({
    urlKey: {
        type: String,
        required: true
    }
})

const toastIsShow = ref(false)
const qrcodeUrl = computed(() => route('url.qr', props.urlKey));
const downloadQrImage = () => {
    const link = document.createElement('a');
    link.href = qrcodeUrl.value;
    link.download = `${props.urlKey}.svg`;
    link.click();
};
</script>

<template>
    <div>
        <popover>
            <QrCodeIcon
                class="h-8 w-8 transition duration-150 ease-in-out text-indigo-600 group-hover:text-indigo-300"
                aria-hidden="true"
            />

            <template #content>
                <div class="min-w-20 min-h-20 w-full h-full">
                    <img
                        class="object-contain object-center w-full h-full"
                        :src="qrcodeUrl"
                        alt="QR CODE">
                </div>
            </template>

            <template #footer>
                <a href="#" class="flex items-center gap-2">
                    <ArrowDownOnSquareStackIcon @click.prevent="downloadQrImage"
                                                class="h-6 w-6 text-indigo-800"
                                                aria-hidden="true"/>
                    <span>Скачать</span>
                </a>
            </template>
        </popover>
    </div>
</template>

<style scoped>

</style>
