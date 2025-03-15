<script setup>
import {computed} from "vue";

const props = defineProps({
    url: Object
})

const date = computed(() => (new Date(Date.parse(props.url.created_at)))
    .toLocaleDateString(undefined,{
        year: "numeric",
        month: "numeric",
        day: "numeric",
    }));

function copyToClipboard() {
    navigator.clipboard.writeText(props.url.default_short_url)
        .then(() => {
            // Можно добавить уведомление или подсказку пользователю, что ссылка скопирована
            alert("Ссылка скопирована в буфер обмена!");
        })
        .catch((error) => {
            console.error("Не удалось скопировать ссылку: ", error);
        });
}
</script>

<template>
    <div class="border rounded-lg p-3 flex items-center gap-2 overflow-hidden">
        <img
            class="object-contain object-center w-14"
            :src="route('url.qr', url.url_key)"
            alt="QR CODE">
        <div>
            <h4 class="font-bold text-lg flex gap-2 items-center overflow-hidden">
                <a href="#" @click.prevent="copyToClipboard">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="currentColor" class="size-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.19 8.688a4.5 4.5 0 0 1 1.242 7.244l-4.5 4.5a4.5 4.5 0 0 1-6.364-6.364l1.757-1.757m13.35-.622 1.757-1.757a4.5 4.5 0 0 0-6.364-6.364l-4.5 4.5a4.5 4.5 0 0 0 1.242 7.244" />
                    </svg>
                </a>
                {{ url.default_short_url }}
            </h4>
            <div class="flex gap-2 text-sm overflow-hidden">
                <p>{{ date }}</p>
                <p>|</p>
                <p class="max-w-xs overflow-hidden whitespace-nowrap text-ellipsis">{{ url.destination_url }}</p>
            </div>
        </div>
    </div>

</template>

<style scoped>

</style>
