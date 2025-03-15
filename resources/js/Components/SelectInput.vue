<script setup>
defineProps({
    values: {
        type: Array,
        required: true
    },
    placeholder: {
        type: String,
        default: null
    }
})
const selected = defineModel();
</script>

<template>
    <select v-model="selected" class="input">
        <option v-if="placeholder" selected>{{placeholder}}</option>
        <option v-for="item in values" :key="item.value"
                :value="item.value">{{item.name}}</option>
    </select>
</template>

<style scoped>
.input{
    @apply bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500;
}
</style>
