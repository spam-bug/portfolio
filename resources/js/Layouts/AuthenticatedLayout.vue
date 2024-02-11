<script setup>
import {onBeforeMount, ref} from 'vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import {Link} from '@inertiajs/vue3';
import SidebarLink from "@/Components/SidebarLink.vue";

let showSidebar = ref(false);

onBeforeMount(() => {
    showSidebar.value = window.innerWidth > 996;

    window.addEventListener('resize', () => {
        if (window.innerWidth > 996) {
            showSidebar.value = true;
        } else {
            showSidebar.value = false;
        }
    });
})
</script>

<template>
    <div class="min-h-screen">
        <div :class="{'translate-x-0': showSidebar}"
             class="h-screen w-64 fixed inset-0 bg-white border-r border-black z-50 -translate-x-full transition-transform duration-300 ease-in-out">
            <div class="h-[67px] flex items-center justify-center border-b border-black">
                <Link :href="route('dashboard')" class="font-climate-crisis text-4xl">Portfolio</Link>
            </div>

            <SidebarLink :href="route('dashboard')" is-active="dashboard">Dashboard</SidebarLink>
            <SidebarLink :href="route('dashboard')" is-active="projects">Projects</SidebarLink>
            <SidebarLink :href="route('dashboard')" is-active="finances">Finances</SidebarLink>
            <SidebarLink :href="route('settings.general')" is-active="/settings">Settings</SidebarLink>
        </div>

        <div :class="{'lg:ml-64': showSidebar}" class="transition-all duration-300 ease-in-out">
            <div class="sticky inset-0 flex justify-end gap-4 bg-white p-4 border-b border-black z-30">
                <Dropdown align="right" width="48">
                    <template #trigger>
                        <span class="inline-flex rounded-md">
                            <button
                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-black bg-white focus:outline-none transition ease-in-out duration-150"
                                type="button"
                            >
                                {{ $page.props.auth.user.name }}

                                <svg
                                    class="ms-2 -me-0.5 h-4 w-4"
                                    fill="currentColor"
                                    viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg"
                                >
                                    <path
                                        clip-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        fill-rule="evenodd"
                                    />
                                </svg>
                            </button>
                        </span>
                    </template>

                    <template #content>
                        <DropdownLink :href="route('profile.edit')"> Profile</DropdownLink>
                        <DropdownLink :href="route('logout')" as="button" method="post">
                            Log Out
                        </DropdownLink>
                    </template>
                </Dropdown>

                <button @click="showSidebar = ! showSidebar">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.5"
                         viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" stroke-linecap="round"
                              stroke-linejoin="round"/>
                    </svg>
                </button>
            </div>

            <div>
                <slot/>
            </div>
        </div>
    </div>
</template>
