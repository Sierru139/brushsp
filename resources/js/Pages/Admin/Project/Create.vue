<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { reactive, ref, createApp } from 'vue';
import { QuillEditor } from '@vueup/vue-quill'

// const app = createApp()
// app.component('QuillEditor', QuillEditor)

const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
const form = useForm({
    title: '',
    banner: null,
    project_number_a: '',
    project_number_b: '',
    client_id: '',
    team_id: '',
    description: '',
    schedule_img: null,
});

console.log(form.project_number_a)

const submit = () => {
    form.post(route('project.store'), {
        onError: (errors) => {
            // Handle the errors if needed
            console.error(errors);
        }
    });
}

const bannerFile = (event) => {
    if (event.target.files.length > 0) {
        form.banner = event.target.files[0];
        // console.log(event.target.files[0]);
    }
};
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
    <Head title="Project - Create" />

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-gradient-to-b from-gray-100 to-gray-200 shadow sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-3xl mb-3"><b>Add Project</b></h3>
								<!-- <pre>{{ form.project_number_a }} - {{ form.project_number_b}}</pre> -->
                        <form @submit.prevent="submit" enctype="multipart/form-data" class="mt-2 p-4">
                        <input type="hidden" name="_token" :value="csrfToken">
                        <div class="mb-6 sm:grid grid-cols-6 gap-3 border-b-2 pb-4">
                            <div class="col-span-2">
                                <label for="project_number_b">Project Number *</label>
                                <div class="">
                                    <div class="relative rounded-md flex items-center">
                                        <input type="text" name="project_number_a" v-model="form.project_number_a" id="project_number_a" class="w-[80px]">
                                        <!-- <select name="project_number_a" v-model="form.project_number_a" id="project_number_a">
                                            <option value="A">A</option>
                                            <option value="B">B</option>
                                            <option value="C">C</option>
                                        </select> -->
                                        <span class="mx-3"> - </span>
                                        <input class="w-full border-0 ring-gray-300 rounded-md"
                                                v-model="form.project_number_b"
                                                name="project_number_b"
                                                id="project_number_b"
                                                type="number"
                                                placeholder="Type a number...">
                                        <!-- <div class="absolute top-0 left-0 bg-gray-300 h-full w-14 flex items-center justify-center">Jam</div> -->
                                    </div>
                                </div>
                                <span class="text-red-500 text-xs">{{ form.errors.project_number_b }}</span>
                                <span class="text-red-500 text-xs">{{ form.errors.project_number_a }}</span>
                            </div>

                            <div class="mb-4 col-span-4">
                                <label for="title">Title *</label>
                                <input class="w-full border-0 rounded-md ring-gray-300"
                                        v-model="form.title"
                                        name="title" id="title"
                                        type="text"
                                        placeholder="Add title...">
                                <span class="text-red-500 text-xs">{{ form.errors.title }}</span>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="banner">Upload Image *</label>
                            <input class="w-full border-0 rounded-md ring-gray-300" name="banner" id="banner" type="file" @change="bannerFile">
                            <span class="text-red-500 text-xs">{{ form.errors.banner }}</span>
                        </div>

                        <!-- <h2 class="text-2xl font-bold mb-3 border-b-2 inline-block">Tanggal</h2> -->
                        <div class="mb-6 sm:grid grid-cols-6 gap-3 border-b-2 pb-4">

                            <div class="col-span-3">
                                <label for="client_id">Client Name *</label>
                                <div class="relative rounded-md overflow-hidden">
                                    <!-- <input class="w-full border-0 ring-gray-300" v-model="form.client_id" name="client_id" id="client_id" type="text"> -->
                                     <select name="client_id"
                                            id="client_id"
                                            v-model="form.client_id"
                                            class="w-full border-0 ring-gray-300">
                                        <!-- <option value="Client_2">Test</option> -->
                                        <option v-for="(item, index) in $page.props.client" :key="index" :value="item.id">{{ item.name }} - {{ item.related_person }}</option>
                                    </select>
                                    <!-- <div class="absolute top-0 left-0 bg-gray-300 h-full w-14 flex items-center justify-center">X</div> -->
                                </div>
                                <span class="text-red-500 text-xs">{{ form.errors.times_of_meeting }}</span>
                            </div>

                            <div class="col-span-3">
                                <label for="team_id">Team Name *</label>
                                <div class="relative rounded-md overflow-hidden">
                                    <!-- <input class="w-full border-0 ring-gray-300" v-model="form.team_id" name="team_id" id="team_id" type="text"> -->
                                    <select name="team_id"
                                            id="team_id"
                                            v-model="form.team_id"
                                            class="w-full border-0 ring-gray-300">
                                            <option v-for="(item, index) in $page.props.team" :key="index" :value="item.id">{{ item.name }}</option>

                                    </select>
                                    <!-- <div class="absolute top-0 left-0 bg-gray-300 h-full w-14 flex items-center justify-center">X</div> -->
                                </div>
                                <span class="text-red-500 text-xs">{{ form.errors.team_id }}</span>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="description">Description</label>
                            <!--<textarea class="w-full border-0 rounded-md ring-gray-300" rows="10" v-model="form.description" name="description" id="description" :disabled="form.mentor_id != ''"></textarea>-->

                            <QuillEditor theme="snow"
                                            :toolbar="[['bold', 'italic'], [{ 'header': 1 }], [{ 'list': 'ordered'}, { 'list': 'bullet' }]]"
                                            v-model:content="form.description"
                                            style="height: 220px;"
                                            contentType="html" name="description" id="description" />
                            <span class="text-red-500 text-xs">{{ form.errors.description }}</span>
                        </div>
                        <Link href="/mentor" class="text-blue-500 hover:text-blue-700">Back</Link>
                        <button type="submit" class="py-1 px-3 bg-gray-300 hover:bg-gray-400 duration-100 rounded">Enter</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</template>
