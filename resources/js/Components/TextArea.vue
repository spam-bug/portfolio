<script setup>
import {onMounted, ref} from "vue";

const model = defineModel({
    type: String,
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
    <textarea
        ref="input"
        v-model="model"
        class="block min-h-44 border border-black focus:border-indigo-500 focus:ring-indigo-500"></textarea>
</template>
