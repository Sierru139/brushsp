<script setup>
import { Head, Link } from '@inertiajs/vue3';
import AdminNavbar from '@/Components/AdminNavbar.vue'
import { usePage } from '@inertiajs/vue3'
import { ref, computed, watch } from "vue";
import { Inertia } from "@inertiajs/inertia";

const { props } = usePage();
const projects = props.projects;
const search = ref("");

const isHovered = ref([]);

watch(
  () => props.project.data,
  (newData) => {
    isHovered.value = newData.map(() => false);
  },
  { immediate: true }
);

const navigate = (url) => {
  if (url) window.location.href = url;
};

const performSearch = () => {
  if (search.value) {
    Inertia.get('/project/search', { search: search.value }, { preserveState: true });
  }
};

const preventDelete = (id) => {
    if (confirm("Are you sure want to delete this project ?")) {
        Inertia.get('/project/delete/' + id, { search: search.value }, { preserveState: true });
    }
};
const formatDate = (dateString) => {
        const date = new Date(dateString);
        return new Intl.DateTimeFormat('default', {dateStyle: 'long'}).format(date);
    };
</script>

<template>
    <Head title="Project" />
    <div class="lg:flex">
        <AdminNavbar></AdminNavbar>
        <div class="w-full">
            <div class="overflow-hidden bg-gray-200">
                <div class="p-6 text-gray-900">
                    <h3 class="text-3xl mb-3"><b>Projects</b></h3>
                    <div class="flex">
                        <input
                            class="bg-gray-50 outline-none ml-1 block w-full rounded"
                            type="text"
                            placeholder="Search..."
                            v-model="search"
                            @keydown.enter="performSearch"
                        />
                        <Link :href="route('project.index')" class="ml-2 p-2 bg-gray-400 hover:bg-gray-500 text-white rounded">Reset</Link>
                    </div>

                    <div class="flex flex-wrap">
                        <Link :href="route('project.create')">
                            <div class="w-[380px] h-full p-2">
                                <div class="bg-gray-300 hover:bg-[#c3c6cc] duration-100 mt-2 px-4 py-2 h-full rounded shadow flex flex-col justify-center items-center">
                                    <img src="/images/icon/add_button.png" class="mb-3 h-[200px] w-[200px] mx-auto opacity-60">
                                    <h3 class="text-xl">Add New Project</h3>
                                </div>
                            </div>
                        </Link>

                        <div class="w-[380px] p-2" v-for="(item, index) in $page.props.project.data" :key="index">
                            <div class="bg-gray-300 mt-2 p-2 rounded shadow h-full flex flex-col">
                                <div class="my-2">
                                    <span class="px-2 py-1 rounded">{{ item.project_code.code }}-{{ item.project_number }}</span>
                                </div>
                                <img :src="'/storage/'+item.banner_img" class="mb-3 h-[300px] w-full rounded-md border">
                                <h3 class="text-xl">{{ item.title }}</h3>

                                <div class="flex flex-wrap gap-1 mt-2">
                                    <span class="bg-gray-100 py-1 px-2 inline-block">Client : {{ item.client.name_jp }} - {{ item.client.name_en }}</span>
                                    <span class="bg-gray-100 py-1 px-2 inline-block">Team : {{ item.team.name }}</span>
                                    <span class="bg-gray-100 py-1 px-2 inline-block">Created By : {{ item.user.name }}</span>
                                </div>

                                <div class="flex mt-2 descs"
                                    :class="{ 'overflow-visible': isHovered[index], 'overflow-hidden': !isHovered[index] }">
                                    <p class="w-fit inline-block whitespace-nowrap mr-1">
                                        {{ formatDate(item.created_at) }}
                                    </p>
                                    <Link class="text-blue-600 underline whitespace-nowrap text-shadow bg-gray-300"
                                            :href="item.link"
                                            @mouseover="isHovered[index] = true"
                                            @mouseleave="isHovered[index] = false">
                                        {{ item.link }}
                                    </Link>
                                </div>

                                <div class="space-x-2 grow flex items-end">
                                    <Link class="text-blue-600 underline" :href="route('project.edit', item.id)">edit</Link>
                                    <button class="text-blue-600 underline" @click="preventDelete(item.id)">delete</button>
                                    <Link class="text-blue-600 underline" :href="route('project.detail', item.slug)">detail</Link>
                                </div>
                            </div>
                        </div>

                        <div v-if="$page.props.project.length < 1 " class="lg:w-[380px] h-[420px] p-2">
                            <div class="mt-2 px-4 py-2 h-full flex flex-col justify-center items-center">
                                <p class="text-center my-4">No Data Shown</p>
                            </div>
                        </div>
                    </div>

                    <!-- Pagination -->
                    <div class="mt-[20px] ml-2">
                        <button
                            class="p-2 bg-gray-300 mr-2 rounded-sm"
                            v-for="(link, index) in $page.props.project.links"
                            :key="index"
                            :disabled="!link.url"
                            @click="navigate(link.url)"
                            :class="{ 'bg-gray-400': link.active }"
                            v-html="link.label"
                        >
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
.overflow-hidden {
    overflow: hidden;
}
.overflow-visible {
    overflow: visible;
    z-index: 99;
}
/*.text-shadow {
    text-shadow: 0px 0px 30px #000000;
}*/
</style>
