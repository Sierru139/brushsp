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

    start_date: '',
    end_date: '',
    times_of_meeting: '',
    duration_of_meeting: '',
    schedule_img: null,
});

const submit = () => {
    form.post(route('course.store'), {
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

const scheduleFile = (event) => {
    if (event.target.files.length > 0) {
        form.schedule_img = event.target.files[0];
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
    <Head title="Dashboard" />

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-gradient-to-b from-gray-100 to-gray-200 shadow sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-3xl mb-3"><b>Add Project</b></h3>

                    <form @submit.prevent="submit" enctype="multipart/form-data" class="mt-2 p-4">
                        <input type="hidden" name="_token" :value="csrfToken">

                        <div class="mb-4">
                            <label for="title">Title *</label>
                            <input class="w-full border-0 rounded-md ring-gray-300" v-model="form.title" name="title" id="title" type="text">
                            <span class="text-red-500 text-xs">{{ form.errors.title }}</span>
                        </div>

                        <div class="mb-4">
                            <label for="banner">Upload Image *</label>
                            <input class="w-full border-0 rounded-md ring-gray-300" name="banner" id="banner" type="file" @change="bannerFile">
                            <span class="text-red-500 text-xs">{{ form.errors.banner }}</span>
                        </div>

                        <!-- <h2 class="text-2xl font-bold mb-3 border-b-2 inline-block">Tanggal</h2> -->
                        <div class="mb-6 sm:grid grid-cols-6 gap-3 border-b-2 pb-4">

                            <div class="col-span-3">
                                <label for="times_of_meeting">Client Name *</label>
                                <div class="relative rounded-md overflow-hidden">
                                    <input class="w-full border-0 ring-gray-300" v-model="form.times_of_meeting" name="times_of_meeting" id="times_of_meeting" type="number">
                                    <!-- <div class="absolute top-0 left-0 bg-gray-300 h-full w-14 flex items-center justify-center">X</div> -->
                                </div>
                                <span class="text-red-500 text-xs">{{ form.errors.times_of_meeting }}</span>
                            </div>

                            <div class="col-span-3">
                                <label for="times_of_meeting">Team Name *</label>
                                <div class="relative rounded-md overflow-hidden">
                                    <input class="w-full border-0 ring-gray-300" v-model="form.times_of_meeting" name="times_of_meeting" id="times_of_meeting" type="number">
                                    <!-- <div class="absolute top-0 left-0 bg-gray-300 h-full w-14 flex items-center justify-center">X</div> -->
                                </div>
                                <span class="text-red-500 text-xs">{{ form.errors.times_of_meeting }}</span>
                            </div>

                            <div class="col-span-2">
                                <label for="duration_of_meeting">Project Number *</label>
                                <div class="relative rounded-md overflow-hidden">
                                    <input class="w-full border-0 ring-gray-300" v-model="form.duration_of_meeting" name="duration_of_meeting" id="duration_of_meeting" type="text">
                                    <!-- <div class="absolute top-0 left-0 bg-gray-300 h-full w-14 flex items-center justify-center">Jam</div> -->
                                </div>
                                <span class="text-red-500 text-xs">{{ form.errors.duration_of_meeting }}</span>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="mentor_profile">Description</label>
                            <!--<textarea class="w-full border-0 rounded-md ring-gray-300" rows="10" v-model="form.mentor_profile" name="mentor_profile" id="mentor_profile" :disabled="form.mentor_id != ''"></textarea>-->

                            <QuillEditor theme="snow"
                                            :toolbar="[['bold', 'italic'], [{ 'header': 1 }], [{ 'list': 'ordered'}, { 'list': 'bullet' }]]"
                                            v-model:content="form.mentor_profile"
                                            style="height: 220px;"
                                            contentType="html" name="mentor_profile" id="mentor_profile" />
                            <span class="text-red-500 text-xs">{{ form.errors.mentor_profile }}</span>
                        </div>
                        <Link href="/mentor" class="text-blue-500 hover:text-blue-700">Back</Link>
                        <button type="submit" class="py-1 px-3 bg-gray-300 hover:bg-gray-400 duration-100 rounded">Done</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</template>
