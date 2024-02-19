<script setup>
import Modal from "@/Components/Modal.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import SelectInput from "@/Components/SelectInput.vue";
import {useForm} from "@inertiajs/vue3";
import axios from "axios";
import {onMounted, ref} from "vue";

const props = defineProps({
    show: {
        type: Boolean,
        default: false,
    }
})

const emit = defineEmits(['projects:create-modal']);

let categories = ref([]);
let subcategories = ref([]);

const form = useForm({
    category: '',
    subcategory: '',
    title: '',
    url: '',
});

onMounted(() => {
    fetchCategories();
});

function submit() {
    form.post(route('projects.create'), {
        onFinish: () => {
            resetForm();
            closeModal();
        }
    })
}

async function fetchCategories() {
    const response = await axios.get(route('projects.categories'));

    categories = response.data;

    if (categories.length > 0) {
        const category = categories[0];
        form.category = category.id;

        if (category.subcategories.length > 0) {
            form.subcategory = category.subcategories[0].id;
        }
    }
}

function closeModal() {
    emit('projects:create-modal', false);
    resetForm();
}

function resetForm() {
    form.reset();
    fetchCategories();
}

function fetchSubcategories(id) {
    const category = categories.find(c => c.id === id);

    return category ? category.subcategories : [];
}

function hasSubcategories(id) {
    const category = categories.find(c => c.id === id);

    return category && category.subcategories.length > 0
}
</script>

<template>
    <Modal :show="props.show">
        <div class="w-full flex items-center justify-between p-4 border-b border-black">
            <p class="text-lg font-medium">New Project</p>

            <button>
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.5"
                     viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path d="M6 18 18 6M6 6l12 12" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </button>
        </div>

        <form class="p-4 space-y-4" @submit.prevent="submit">
            <div>
                <InputLabel for="category" value="Category"/>

                <SelectInput id="category" v-model="form.category" class="w-full mt-1" required>
                    <option v-for="category in categories" :value="category.id">{{ category.name }}</option>
                </SelectInput>

                <InputError :message="form.errors.category" class="mt-2"/>
            </div>

            <div v-if="hasSubcategories(form.category)">
                <InputLabel for="subcategory" value="Subcategory"/>

                <SelectInput id="subcategory" v-model="form.subcategory" class="w-full mt-1" required>
                    <option v-for="subcategory in fetchSubcategories(form.category)" :value="subcategory.id">
                        {{ subcategory.name }}
                    </option>
                </SelectInput>

                <InputError :message="form.errors.subcategory" class="mt-2"/>
            </div>

            <div>
                <InputLabel for="title" value="Project Title"/>

                <TextInput
                    id="title"
                    v-model="form.title"
                    autocomplete="title"
                    autofocus
                    class="mt-1 w-full"
                    required
                    type="text"
                />

                <InputError :message="form.errors.title" class="mt-2"/>
            </div>

            <div>
                <InputLabel for="url" value="Project Url"/>

                <TextInput
                    id="url"
                    v-model="form.url"
                    autocomplete="url"
                    autofocus
                    class="mt-1 w-full"
                    required
                    type="url"
                />

                <InputError :message="form.errors.url" class="mt-2"/>
            </div>

            <div class="flex justify-end gap-2">
                <SecondaryButton @click="closeModal">Cancel</SecondaryButton>

                <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Save
                </PrimaryButton>
            </div>
        </form>
    </Modal>
</template>
