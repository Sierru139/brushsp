<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm, usePage} from '@inertiajs/vue3';
import { reactive, ref, createApp } from 'vue';
import { QuillEditor } from '@vueup/vue-quill'

// const app = createApp()
// app.component('QuillEditor', QuillEditor)

const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
const page = usePage();
const form = useForm({
    name_en: page.props.client.name_en,
    name_jp: page.props.client.name_jp,
});

const submit = () => {
    form.post(route('clients.update', page.props.client.id), {
        onError: (errors) => {
            console.error(errors);
        }
    });
}
</script>

<style>
input:disabled:hover,
input:disabled:active,
input:disabled:focus,
textarea:disabled:hover,
textarea:disabled:active,
textarea:disabled:focus,
textarea:disabled,
input:disabled {
  background-color: rgb(245, 245, 245);
  border: 1px solid rgba(128, 128, 128, 0.3);
  cursor: not-allowed;
}
 input[type="number"]::-webkit-outer-spin-button,
 input[type="number"]::-webkit-inner-spin-button {
	 -webkit-appearance: none;
	 margin: 0;
 }

 .ql-editor {
    background-color: white;
 }
</style>

<template>
    <Head title="Team - Edit" />

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-gradient-to-b from-gray-100 to-gray-200 shadow sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-3xl mb-3"><b>Edit Project</b></h3>

                    <form @submit.prevent="submit" enctype="multipart/form-data" class="mt-2 p-4">
                        <input type="hidden" name="_token" :value="csrfToken">
                        <div class="mb-4">
                            <label for="name_jp">name(JP) *</label>
                            <input class="w-full border-0 rounded-md ring-gray-300" v-model="form.name_jp" name_jp="name_jp" id="name_jp" type="text">
                            <span class="text-red-500 text-xs">{{ form.errors.name_jp }}</span>
                        </div>

                        <div class="mb-4">
                            <label for="name_en">name(EN)*</label>
                            <input class="w-full border-0 rounded-md ring-gray-300" v-model="form.name_en" name_en="name_en" id="name_en" type="text">
                            <span class="text-red-500 text-xs">{{ form.errors.name_en }}</span>
                        </div>
                        <Link href="/clients" class="text-blue-500 hover:text-blue-700">Back</Link>
                        <button type="submit" class="py-1 px-3 bg-gray-300 hover:bg-gray-400 duration-100 rounded">Save</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</template>
