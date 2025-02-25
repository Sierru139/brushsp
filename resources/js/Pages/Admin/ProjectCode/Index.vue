
<script>
import AdminNavbar from '@/Components/AdminNavbar.vue'
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
                            <b>Project Code</b>
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
                            <Link :href="route('projectCode.index')"
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
                        <p class="my-6">
                            <Link :href="route('projectCode.create')" class="mt-20 bg-gray-400 py-2 px-4 hover:bg-gray-300">Add Project Code</Link>
                        </p>
                        <table class="w-full my-6">
                            <thead class="text-left">
                                <tr class="bg-[#c3c3c3] border border-gray-400">
                                    <th class="p-4 w-[10%]">No</th>
                                    <th class="p-4">Code</th>
                                </tr>
                            </thead>
                            <tbody v-for="(item, index) in $page.props.projectCode.data" :key="index">
                                <tr class="border border-gray-400">
                                    <td class="p-4 w-[10%]">{{ index + 1 }}</td>
                                    <td class="p-4">{{ item.code }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="mt-[20px] ml-2">
                        <button
                            class="p-2 bg-gray-300 mr-2 rounded-sm"
                            v-for="(link, index) in $page.props.projectCode.links"
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
    Inertia.get('/project-code/search', { search: search.value }, {
      preserveState: true,
    });
  }
};
</script>
