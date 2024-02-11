<script setup>
import SettingsLayout from "@/Layouts/SettingsLayout.vue";
import {Head} from "@inertiajs/vue3";
import HeroSectionForm from "@/Pages/Settings/Partials/HeroSectionForm.vue";
import AboutSectionForm from "@/Pages/Settings/Partials/AboutSectionForm.vue";
import ContactSectionForm from "@/Pages/Settings/Partials/ContactSectionForm.vue";
</script>

<template>
    <Head title="General Settings"/>

    <SettingsLayout>
        <template #title>
            General Settings
        </template>

        <div class="divide-y divide-black">
            <HeroSectionForm/>
            <AboutSectionForm/>
            <ContactSectionForm/>
        </div>
    </SettingsLayout>
</template>
