
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
                            <b>Projects</b>
                        </h3>
                        <div class="flex">
                            <!-- <Link :href="route('client.index')" class="bg-gray-100  py-2 px-4 whitespace-nowrap border border-black hover:bg-gray-200">GO BACK</Link> -->
                            <input
                                class="bg-gray-50 outline-none ml-1 block w-full rounded"
                                type="text"
                                placeholder="Search..."
                                v-model="search"
                                @keydown.enter="performSearch"
                            />
                            <button
                                class="ml-2 p-2 bg-gray-400 hover:bg-gray-500 text-white rounded"
                                @click="search = ''; performSearch()"
                            >
                                Reset
                            </button>
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
                            <Link class="py-1 px-3 bg-gray-300 rounded" :href="route('client.create')">Make New</Link>
                        </p> -->
                        <p class="my-6">
                            <Link :href="route('clients.create')" class="mt-20 bg-gray-400 py-2 px-4 hover:bg-gray-300">Add client</Link>
                        </p>
                            <table class="w-full my-6">
                                <thead class="text-left">
                                    <tr class="bg-[#c3c3c3] border border-black">
                                        <th class="p-4 w-[10%]">No</th>
                                        <th class="p-4">Name</th>
                                    </tr>
                                </thead>
                                <tbody v-for="(item, index) in $page.props.clients.data" :key="index">
                                    <tr class="border border-black">
                                        <td class="p-4 w-[10%]">{{ index + 1 }}</td>
                                        <td class="p-4">{{ item.name }}</td>
                                    </tr>
                                </tbody>
                            </table>

                        <!-- <div class="flex flex-wrap">
                            <Link :href="route('clients.create')">
                                <div class="w-[380px] h-full p-2">
                                    <div class="bg-gray-300 hover:bg-[#c3c6cc] duration-100 mt-2 px-4 py-2 h-full rounded shadow flex flex-col justify-center items-center">
                                        <img src="/images/icon/add_button.png" class="mb-3 h-[200px] w-[200px] mx-auto opacity-60">
                                        <h3 class="text-xl">Add New Project</h3>
                                    </div>
                                </div>
                            </Link>
                            <div class="w-[380px] p-2" v-for="(item, index) in clients" :key="index">
                                <div class="bg-gray-300 mt-2 p-2 rounded shadow h-full flex flex-col">
                                    <h3 class="text-xl">{{ item.title }}</h3>
                                    <p>{{ item.description }}</p>
                                    <div class="flex flex-wrap gap-1 mt-2">
                                        <span class="bg-gray-100 py-1 px-2 inline-block">Client : {{ item.client_name }}</span>
                                        <span class="bg-gray-100 py-1 px-2 inline-block">Team : {{ item.team_name }}</span>
                                        <span class="bg-gray-100 py-1 px-2 inline-block">Related Person : {{ item.client_name }}</span>
                                    </div>
                                    <div class="space-x-2 grow flex items-end">
                                        <Link class="text-blue-600 underline" :href="route('clients.edit', item.id)">edit</Link>
                                        <Link class="text-blue-600 underline" :href="route('clients.delete', item.id)">delete</Link>
                                        <Link class="text-blue-600 underline" :href="route('clients.detail', item.slug)">detail</Link>
                                    </div>
                                </div>
                            </div>
                            <div v-if="$page.props.clients.length < 1 " class="lg:w-[380px] h-[420px] p-2">
                                <div class="mt-2 px-4 py-2 h-full flex flex-col justify-center items-center">
                                    <p class="text-center my-4">No Data Shown</p>
                                </div>
                            </div>
                        <div class="mt-[20px] ml-2">
                        <button
                            class="p-2 bg-gray-300 mr-2 rounded-sm"
                            v-for="(link, index) in $page.props.clients.links"
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
const clients = props.clients
const navigate = (url) => {
  if (url) {
    window.location.href = url
  }
}
let search = ref("");
const performSearch = () => {
    if (search.value) {
        Inertia.get('/clients/search', { search: search.value }, {
        preserveState: true,
        });
    }
};
</script>
