<script setup>

import {computed} from "vue";

const props = defineProps({
    text: {
        type: String,
        required: true,
    },
    type: {
        type: String,
        default: 'light'
    }
})

const typeClass = computed(() => {
    if (props.type === 'info') {
        return 'border-blue-700 bg-blue-100 text-blue-700';
    } else if (props.type === 'success') {
        return 'border-green-700 bg-green-100 text-green-700';
    } else if (props.type === 'warning') {
        return 'border-yellow-700 bg-yellow-100 text-yellow-700';
    } else if (props.type === 'danger') {
        return 'border-red-700 bg-red-100 text-red-700';
    } else {
        return 'border-gray-700 bg-gray-100 text-gray-700';
    }
})
</script>

<template>
    <span
        :class="[typeClass]"
        class="text-xs inline-block rounded px-2 py-1 font-medium tracking-wider border"
    >
        {{ props.text }}
    </span>
</template>
