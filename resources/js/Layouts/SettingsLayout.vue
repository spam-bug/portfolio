<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import SidebarLink from "@/Components/SidebarLink.vue";
</script>

<template>
    <AuthenticatedLayout>
        <div class="h-[calc(100vh-67px)] flex flex-col lg:flex-row relative">
            <div
                class="border-b border-black bg-white lg:fixed lg:h-full lg:w-64 lg:border-r lg:border-b-0 lg:z-10">
                <div class="p-4">
                    <h3 class="text-2xl">
                        Settings
                    </h3>
                </div>

                <SidebarLink :href="route('settings.general')">General</SidebarLink>
                <SidebarLink :href="route('settings.general')">Profile</SidebarLink>
                <SidebarLink :href="route('settings.general')">Accounts</SidebarLink>
                <SidebarLink :href="route('settings.general')">Social Media</SidebarLink>
                <SidebarLink :href="route('settings.general')">Project Showcase</SidebarLink>
                <SidebarLink :href="route('settings.general')">Finance Sources</SidebarLink>
            </div>

            <div class="flex-1 lg:ml-64">
                <div class="p-4 sm:p-6 lg:p-8 border-b border-black">
                    <h1 class="text-4xl">
                        <slot name="title"/>
                    </h1>

                    <p class="mt-2">Manage the content of the website.</p>
                </div>

                <div>
                    <slot/>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
