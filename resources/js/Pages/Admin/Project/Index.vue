
<script>
export default {
    methods: {
        formatDate(dateString) {
            const date = new Date(dateString);
                // Then specify how you want your dates to be formatted
            return new Intl.DateTimeFormat('default', {dateStyle: 'long'}).format(date);
        }
    }
}
</script>
<template>
    <Head title="Dashboard" />
        <div class="lg:flex">
            <AdminNavbar></AdminNavbar>
            <div class="w-full max-lg:mt-[80px]">
                <div
                    class="overflow-hidden bg-gray-200"
                >

                    <div class="p-6 text-gray-900">
                        <h3 class="text-3xl mb-3">
                            <b>Projects</b>
                        </h3>
                        <div class="flex">
                            <!-- <Link :href="route('project.index')" class="bg-gray-100  py-2 px-4 whitespace-nowrap border border-black hover:bg-gray-200">GO BACK</Link> -->
                            <input
                                class="bg-gray-50 outline-none ml-1 block w-full rounded"
                                type="text"
                                placeholder="Search..."
                                v-model="search"
                                @keydown.enter="performSearch"
                            />
                            <!-- <button
                                class="ml-2 p-2 bg-gray-400 hover:bg-gray-500 text-white rounded"
                                @click="search = ''; performSearch()"
                            >
                                Reset
                            </button> -->
                            <Link :href="route('project.index')"
                                    class="ml-2 p-2 bg-gray-400 hover:bg-gray-500 text-white rounded">
                                    Reset
                            </Link>

                        </div>
                        <!-- Success message -->
                        <div v-if="$page.props.flash.success" class="bg-[#d4edda] mb-4 p-4">
                            <b class="text-[#155724]">
                                {{ $page.props.flash.success }}
                            </b>
                        </div>
                        <div v-if="$page.props.flash.error" class="bg-red-200 mb-4 p-4">
                            <b class="text-[#cc315d]">
                                {{ $page.props.flash.error }}
                            </b>
                        </div>
                        <!-- Success message end -->
                        <!-- <p class="mb-3 text-right">
                            <Link class="py-1 px-3 bg-gray-300 rounded" :href="route('project.create')">Make New</Link>
                        </p> -->

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
                                        <span class="px-2 py-1 rounded">{{ item.project_code }}-{{ item.project_number }}</span>
                                    </div>
                                    <img :src="'/storage/'+item.banner_img" class="mb-3 h-[300px] w-full rounded-md border">
                                    <h3 class="text-xl">{{ item.title }}</h3>
                                    <!-- <p>{{ item.description }}</p> -->
                                    <div class="flex flex-wrap gap-1 mt-2">
                                        <span class="bg-gray-100 py-1 px-2 inline-block">Client : {{ item.client.name_jp }} - {{ item.client.name_en }}</span>
                                        <span class="bg-gray-100 py-1 px-2 inline-block">Team : {{ item.team.name }}</span>
                                        <!-- <span class="bg-gray-100 py-1 px-2 inline-block">Related Person : {{ item.client.related_person }}</span> -->
                                    </div>
                                    <p>{{ formatDate(item.created_at) }}</p>
                                    <div class="space-x-2 grow flex items-end">
                                        <Link class="text-blue-600 underline" :href="route('project.edit', item.id)">edit</Link>
                                        <Link class="text-blue-600 underline" :href="route('project.delete', item.id)">delete</Link>
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
<script setup>
import { Head, Link } from '@inertiajs/vue3';
import AdminNavbar from '@/Components/AdminNavbar.vue'
import { usePage } from '@inertiajs/vue3'
import { ref } from "vue";
import { watch } from "vue";
import { Inertia } from "@inertiajs/inertia";

const { props } = usePage()
const projects = props.projects
const navigate = (url) => {
  if (url) {
    window.location.href = url
  }
}
let search = ref("");
const performSearch = () => {
  if (search.value) {
    Inertia.get('/project/search', { search: search.value }, {
      preserveState: true,
    });
  }
};
</script>
