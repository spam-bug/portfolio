<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {Head, Link} from "@inertiajs/vue3";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import {ref} from "vue";
import CreateProjectForm from "@/Pages/Projects/Partials/CreateProjectForm.vue";
import Badge from "@/Components/Badge.vue";

let showModal = ref(false);

defineProps({
    projects: Object,
    categories: Object,
    publishedProjectCount: Number
});

function isActive(category) {
    const queryString = window.location.search;
    const params = new URLSearchParams(queryString);

    return category === params.get('category');
}

function hasNoQueryParams() {
    const queryString = window.location.search;
    const params = new URLSearchParams(queryString);

    return !params.has('category');
}
</script>

<template>
    <Head title="Projects"/>

    <AuthenticatedLayout>
        <div class="p-4 sm:p-6 lg:p-8 border-b border-black">
            <h1 class="text-4xl">
                Projects
            </h1>
        </div>

        <div class="w-full flex items-center justify-between gap-2 px-4 py-2 border-b border-black">
            <div class="flex items-center gap-4">
                <Link :class="hasNoQueryParams() ? 'text-black font-medium' : 'text-gray-500'"
                      :href="route('projects')">All
                </Link>
                <Link
                    v-for="category in categories"
                    :class="isActive(category.slug) ? 'text-black font-medium' : 'text-gray-500'"
                    :href="route('projects', { category: category.slug })"
                >
                    {{ category.name }}
                </Link>
            </div>

            <div class="flex items-center justify-center gap-4">
                <p>{{ publishedProjectCount }}/5</p>
                <PrimaryButton @click="showModal = true">New</PrimaryButton>
            </div>
        </div>

        <div class="relative h-full">
            <table class="w-full">
                <thead>
                <tr class="border-b border-gray-400">
                    <th class="text-left px-4 py-2 font-semibold tracking-wide">Title</th>
                    <th class="text-left px-4 py-2 font-semibold tracking-wide">Category</th>
                    <th class="text-left px-4 py-2 font-semibold tracking-wide">Status</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="project in projects"
                    class="border-b border-gray-400 hover:bg-gray-100 transition-colors duration-300 ease-in-out">
                    <td class="text-left p-4">
                        <div class="flex items-center gap-2">
                            <svg v-if="project.category === 'Video Editing'" class="w-6 h-6 stroke-red-700" fill="none"
                                 stroke="currentColor" stroke-width="1.5"
                                 viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M3.375 19.5h17.25m-17.25 0a1.125 1.125 0 0 1-1.125-1.125M3.375 19.5h1.5C5.496 19.5 6 18.996 6 18.375m-3.75 0V5.625m0 12.75v-1.5c0-.621.504-1.125 1.125-1.125m18.375 2.625V5.625m0 12.75c0 .621-.504 1.125-1.125 1.125m1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125m0 3.75h-1.5A1.125 1.125 0 0 1 18 18.375M20.625 4.5H3.375m17.25 0c.621 0 1.125.504 1.125 1.125M20.625 4.5h-1.5C18.504 4.5 18 5.004 18 5.625m3.75 0v1.5c0 .621-.504 1.125-1.125 1.125M3.375 4.5c-.621 0-1.125.504-1.125 1.125M3.375 4.5h1.5C5.496 4.5 6 5.004 6 5.625m-3.75 0v1.5c0 .621.504 1.125 1.125 1.125m0 0h1.5m-1.5 0c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125m1.5-3.75C5.496 8.25 6 7.746 6 7.125v-1.5M4.875 8.25C5.496 8.25 6 8.754 6 9.375v1.5m0-5.25v5.25m0-5.25C6 5.004 6.504 4.5 7.125 4.5h9.75c.621 0 1.125.504 1.125 1.125m1.125 2.625h1.5m-1.5 0A1.125 1.125 0 0 1 18 7.125v-1.5m1.125 2.625c-.621 0-1.125.504-1.125 1.125v1.5m2.625-2.625c.621 0 1.125.504 1.125 1.125v1.5c0 .621-.504 1.125-1.125 1.125M18 5.625v5.25M7.125 12h9.75m-9.75 0A1.125 1.125 0 0 1 6 10.875M7.125 12C6.504 12 6 12.504 6 13.125m0-2.25C6 11.496 5.496 12 4.875 12M18 10.875c0 .621-.504 1.125-1.125 1.125M18 10.875c0 .621.504 1.125 1.125 1.125m-2.25 0c.621 0 1.125.504 1.125 1.125m-12 5.25v-5.25m0 5.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125m-12 0v-1.5c0-.621-.504-1.125-1.125-1.125M18 18.375v-5.25m0 5.25v-1.5c0-.621.504-1.125 1.125-1.125M18 13.125v1.5c0 .621.504 1.125 1.125 1.125M18 13.125c0-.621.504-1.125 1.125-1.125M6 13.125v1.5c0 .621-.504 1.125-1.125 1.125M6 13.125C6 12.504 5.496 12 4.875 12m-1.5 0h1.5m-1.5 0c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125M19.125 12h1.5m0 0c.621 0 1.125.504 1.125 1.125v1.5c0 .621-.504 1.125-1.125 1.125m-17.25 0h1.5m14.25 0h1.5"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"/>
                            </svg>

                            <svg v-else class="w-6 h-6 stroke-blue-700" fill="none" stroke="currentColor"
                                 stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"/>
                            </svg>


                            {{ project.title }}
                        </div>
                    </td>
                    <td class="text-left p-4">{{ project.category }}</td>
                    <td class="text-left p-4">
                        <Badge :text="project.status" :type="project.status === 'published' ? 'info' : 'light'"/>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </AuthenticatedLayout>

    <CreateProjectForm :show="showModal" @projects:create-modal="showModal = $event"/>
</template>
