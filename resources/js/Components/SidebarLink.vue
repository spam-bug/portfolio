<script setup>
import {Link} from "@inertiajs/vue3";

const props = defineProps({
    href: {
        type: String,
        required: true,
    },
    isActive: {
        type: String,
        required: true,
    }
})
</script>

<template>
    <Link
        :class="{'bg-black text-white': $page.url.startsWith(props.isActive)}"
        :href="href"
        class="block px-4 py-2 hover:bg-black hover:text-white focus:bg-black focus:text-white focus:outline-none transition-colors duration-200 ease-in-out">
        <slot/>
    </Link>
</template>
