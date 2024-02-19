<script setup>
import {onMounted, ref} from "vue";

const model = defineModel({
    required: true,
})

const input = ref(null);

onMounted(() => {
    if (input.value.hasAttribute('autofocus')) {
        input.value.focus();
    }
});

defineExpose({focus: () => input.value.focus()});
</script>

<template>
    <select
        ref="input"
        v-model="model"
        class="block border border-black focus:border-indigo-500 focus:ring-indigo-500"
    >
        <slot/>
    </select>
</template>
