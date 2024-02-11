<script setup>
import TextInput from "@/Components/TextInput.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import InputLabel from "@/Components/InputLabel.vue";
import InputError from "@/Components/InputError.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import {useForm} from "@inertiajs/vue3";
import {onMounted, ref} from "vue";

const form = useForm({
    email: '',
    mobile_number: '',
})

let hasBeenModified = ref(false);

onMounted(() => {
    fetchContactSectionSettings();
});

function submit() {
    form.put(route('contact-section.update'), {
        preserveScroll: true,
        onFinish: () => {
            fetchContactSectionSettings();
            hasBeenModified.value = false;
        }
    });
}

async function fetchContactSectionSettings() {
    const response = await axios.get(route('contact-section'));

    form.email = response.data.email;
    form.mobile_number = response.data.mobile_number;
}

function discardChanges() {
    fetchContactSectionSettings();
    hasBeenModified.value = false;
}
</script>

<template>
    <form class="w-full grid lg:grid-cols-2 gap-8 p-4 sm:p-6 lg:p-8" @submit.prevent="submit">
        <div>
            <h6 class="font-semibold">Contact Section</h6>
            <p class="mt-1">
                The different information on the client can contact you.
            </p>
        </div>

        <div class="space-y-4">
            <div>
                <InputLabel for="email" value="Email Address"/>

                <TextInput
                    id="email"
                    v-model="form.email"
                    autocomplete="email"
                    autofocus
                    class="mt-1 w-full"
                    required
                    type="email"
                    @input="hasBeenModified = true"
                />

                <InputError :message="form.errors.email" class="mt-2"/>
            </div>

            <div>
                <InputLabel for="mobile_number" value="Mobile Number"/>

                <TextInput
                    id="mobile_number"
                    v-model="form.mobile_number"
                    autocomplete="mobile_number"
                    autofocus
                    class="mt-1 w-full"
                    required
                    type="text"
                    @input="hasBeenModified = true"
                />

                <InputError :message="form.errors.mobile_number" class="mt-2"/>
            </div>

            <div v-show="hasBeenModified" class="flex justify-end gap-2">
                <SecondaryButton>Discard</SecondaryButton>

                <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Save
                </PrimaryButton>
            </div>
        </div>
    </form>
</template>
