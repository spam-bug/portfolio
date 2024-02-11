<script setup>
import PrimaryButton from "@/Components/PrimaryButton.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextArea from "@/Components/TextArea.vue";
import InputError from "@/Components/InputError.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import {useForm} from "@inertiajs/vue3";
import {onMounted, ref} from "vue";

const form = useForm({
    description: '',
})

let hasBeenModified = ref(false);

function submit() {
    form.put(route('about-section.update'), {
        preserveScroll: true,
        onFinish: () => {
            fetchAboutSectionSettings()
        }
    });
}

onMounted(() => {
    fetchAboutSectionSettings();
    hasBeenModified.value = false;
});

async function fetchAboutSectionSettings() {
    const response = await axios.get(route('about-section'));

    form.description = response.data.description;
}

function discardChanges() {
    fetchAboutSectionSettings();
    hasBeenModified.value = false;
}
</script>

<template>
    <form class="w-full grid lg:grid-cols-2 gap-8 p-4 sm:p-6 lg:p-8" @submit.prevent="submit">
        <div>
            <h6 class="font-semibold">About Section</h6>
            <p class="mt-1">
                An introduction about yourself or what this website all about.
            </p>
        </div>

        <div class="space-y-4">
            <div>
                <InputLabel for="description" value="About Description"/>

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
