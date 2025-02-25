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
    project_code_id: page.props.project.project_code.id,
    project_number: page.props.project.project_number,
    title: page.props.project.title,
    link: page.props.project.link,
    banner: page.props.project.banner_img,
    new_banner: null,
    client_id: page.props.project.client.id,
    team_id: page.props.project.team.id,
    // client_id:'',
    // team_id:'',
    // project_number: page.props.project.project_number,
    description: page.props.project.description,
});

var editMentor = ref(true);
var createMentor = ref(false);

const editMentorTrue = () => {
    editMentor.value = true;
    createMentor.value = false;
};

const createMentorTrue = () => {
    createMentor.value = true;
    editMentor.value = false;
};


const submit = () => {
    form.post(route('project.update', page.props.project.id), {
        onError: (errors) => {
            // Handle the errors if needed
            console.error(errors);
        }
    });
}
const handleFileChange = (event) => {
    if (event.target.files.length > 0) {
        form.new_banner = event.target.files[0];
        console.log(event.target.files[0]);
    }
};

const logSelectedOption = (value) => {
    console.log('Selected Option:', form.mentor_id);
}

const addLeadingZeros = (value, length = 4) => {
    return value.length < length ? value.toString().padStart(length, '0') : value;
};

const handleProjectNumberInput = (event) => {
    let value = event.target.value.replace(/\D/g, ''); // Remove non-numeric characters
    if (value.length === 1) {
        value = value.padStart(1, '0'); // Add a single leading zero for single digits
    }
    form.project_number = value; // Update form value
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
    <Head title="Project - Edit" />
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-gradient-to-b from-gray-100 to-gray-200 shadow sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-3xl mb-3"><b>Edit Project</b></h3>
                        <form @submit.prevent="submit" enctype="multipart/form-data" class="mt-2 p-4">
                        <input type="hidden" name="_token" :value="csrfToken">
                        <div class="mb-6 sm:grid grid-cols-6 gap-3 border-b-2 pb-4">
                            <div class="col-span-2">
                                <label for="project_number">Project Number*</label>
                                <div class=" ">
                                    <div class="relative rounded-md flex items-center">
                                        <select name="project_code_id"
                                                id="project_code_id"
                                                v-model="form.project_code_id"
                                                class="min-w-[100px] border-0 ring-gray-300">
                                            <option :value="$page.props.project.project_code.id">{{ $page.props.project.project_code.code }}</option>
                                            <option v-for="(item, index) in $page.props.projectCodes" :key="index" :value="item.id">{{ item.code }}</option>
                                        </select>
                                        <span class="mx-3"> - </span>
                                            <input class="w-full border-0 ring-gray-300 rounded-md"
                                            :value="form.project_number"
                                            name="project_number"
                                            id="project_number"
                                            @input="handleProjectNumberInput"
                                            type="number"
                                            placeholder="Type a number...">
                                    </div>
                                </div>
                                <span class="text-red-500 text-xs">{{ form.errors.project_number }}</span>
                            </div>

                            <div class="mb-4 col-span-4">
                                <label for="title">Title*</label>
                                <input class="w-full border-0 rounded-md ring-gray-300"
                                        v-model="form.title"
                                        name="title" id="title"
                                        type="text"
                                        placeholder="Add title...">
                                <span class="text-red-500 text-xs">{{ form.errors.title }}</span>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="banner">Upload Banner*</label>
                            <div class="border border-black p-2 mb-2 w-fit">
                                <small>current banner</small>
                                <img :src="'/storage/'+form.banner" alt="" class="h-44">
                            </div>
                            <span class="text-red-500 text-xs">{{ form.errors.new_banner }}</span>
                        </div>
                        <div class="mb-4">
                            <label for="banner">Upload Image*</label>
                            <input class="w-full border-0 rounded-md ring-gray-300" name="banner" id="banner" type="file" @change="bannerFile">
                            <span class="text-red-500 text-xs">{{ form.errors.banner }}</span>
                        </div>

                        <div class="mb-6 sm:grid grid-cols-6 gap-3 border-b-2 pb-4">

                            <div class="col-span-3">
                                <label for="client_id">Client Name*</label>
                                <div class="relative rounded-md overflow-hidden">
                                     <select name="client_id"
                                            id="client_id"
                                            v-model="form.client_id"
                                            class="w-full border-0 ring-gray-300">
                                            <option :value="$page.props.project.client.id">{{ $page.props.project.client.name_jp }} - {{ $page.props.project.client.name_en  }}</option>
                                            <option v-for="(item, index) in $page.props.clients" :key="index" :value="item.id">{{ item.name_jp }} - {{ item.name_en }}</option>
                                    </select>
                                </div>
                                <span class="text-red-500 text-xs">{{ form.errors.times_of_meeting }}</span>
                            </div>

                            <div class="col-span-3">
                                <label for="team_id">Team Name*</label>
                                <div class="relative rounded-md overflow-hidden">
                                    <select name="team_id"
                                            id="team_id"
                                            v-model="form.team_id"
                                            class="w-full border-0 ring-gray-300">
                                            <option :value="$page.props.project.team.id">{{ $page.props.project.team.name }}</option>
                                            <option v-for="(item, index) in $page.props.teams" :key="index" :value="item.id">{{ item.name }}</option>
                                    </select>
                                </div>
                                <span class="text-red-500 text-xs">{{ form.errors.team_id }}</span>
                            </div>
                        </div>
                        <div class="relative rounded-md overflow-hidden">
                            <label for="link">link*</label>
                            <input class="w-full border-0 rounded-md ring-gray-300"
                                    v-model="form.link"
                                    name="link" id="link"
                                    type="text"
                                    placeholder="Add link...">
                            <span class="text-red-500 text-xs">{{ form.errors.link }}</span>
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
                        <button type="submit" class="py-1 px-3 bg-gray-300 hover:bg-gray-400 duration-100 rounded">Save</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</template>
