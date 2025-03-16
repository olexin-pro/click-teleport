<script setup>
import { ref, onMounted, watch, defineProps } from 'vue';

// Пропсы для компонента
const props = defineProps({
    message: {
        type: String,
        required: true
    },
    duration: {
        type: Number,
        default: 3000
    },
    variant: {
        type: String,
        default: 'info'
    }
});

const showToast = defineModel({default: false, type: Boolean});
const isVisible = ref(showToast.value);

// Закрытие уведомления
const closeToast = () => {
    isVisible.value = false;
};

watch(showToast, (newValue) => {
    if (newValue) {
        isVisible.value = true;
        setTimeout(closeToast, props.duration);
    } else {
        isVisible.value = false;
        showToast.value = false;
    }
});
</script>

<template>
    <div v-if="isVisible" class="toast" :class="[`toast--${variant}`]" @click="closeToast">
        <div v-if="$slots.icon" class="toast-icon">
            <slot name="icon"/>
        </div>
        <div class="toast-message">
            {{ message }}
        </div>
    </div>
</template>

<style scoped>
.toast {
    display: flex;
    align-items: center;
    padding: 10px;
    background-color: #333;
    color: white;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    position: fixed;
    top: 20px;
    right: 20px;
    z-index: 9999;
    opacity: 1;
    transition: opacity 0.3s ease;
}

.toast-icon {
    margin-right: 10px;
}

.toast-message {
    flex-grow: 1;
}

.toast.toast--success {
    background-color: #28a745;
}

.toast.toast--error {
    background-color: #dc3545;
}

.toast.toast--info {
    background-color: #17a2b8;
}

.toast.toast--warning {
    background-color: #ffc107;
}
</style>
