<script setup>
import TextInput from "@/Components/TextInput.vue";
import TextArea from "@/Components/TextArea.vue";
import InputLabel from "@/Components/InputLabel.vue";
import InputError from "@/Components/InputError.vue";
import {useForm} from "@inertiajs/vue3";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import {onMounted, ref} from "vue";

const form = useForm({
    title: '',
    description: ''
})

let hasBeenModified = ref(false);

onMounted(() => {
    fetchHeroSettings();
})

function submit() {
    form.put(route('hero-section.update'), {
        preserveScroll: true,
        onFinish: () => {
            fetchHeroSettings();
            hasBeenModified.value = false;
        }
    })
}

function discardChanges() {
    fetchHeroSettings();
    hasBeenModified.value = false
}

async function fetchHeroSettings() {
    const response = await axios.get(route('hero-section'));

    form.title = response.data.title;
    form.description = response.data.description;
}
</script>

<template>
    <form class="w-full grid lg:grid-cols-2 gap-8 p-4 sm:p-6 lg:p-8" @submit.prevent="submit">
        <div>
            <h6 class="font-semibold">Hero Section</h6>
            <p class="mt-1">
                The section located at the very top of the homepage.
            </p>
        </div>

        <div class="space-y-4">
            <div>
                <InputLabel for="title" value="Hero Title"/>

                <TextInput
                    id="title"
                    v-model="form.title"
                    autocomplete="title"
                    autofocus
                    class="mt-1 w-full"
                    required
                    type="text"
                    @input="hasBeenModified = true"
                />

                <InputError :message="form.errors.title" class="mt-2"/>
            </div>

            <div>
                <InputLabel for="description" value="Hero Description"/>

                <TextArea
                    id="description"
                    v-model="form.description"
                    autocomplete="description"
                    autofocus
                    class="mt-1 w-full"
                    required
                    @input="hasBeenModified = true"
                />

                <InputError :message="form.errors.description" class="mt-2"/>
            </div>

            <div v-show="hasBeenModified" class="flex justify-end gap-2">
                <SecondaryButton @click="discardChanges">Discard</SecondaryButton>

                <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Save
                </PrimaryButton>
            </div>
        </div>
    </form>
</template>
