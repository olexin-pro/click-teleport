<script setup>
import UrlCard from "@/Components/Url/UrlCard.vue";

defineProps({
    urls: {
        type: Array,
        required: true
    }
})
</script>

<template>
<div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
    <url-card v-for="url in urls" :key="url.id" :url="url"/>
</div>
</template>

<style scoped>

</style>
