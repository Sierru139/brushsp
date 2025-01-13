
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
                            <!-- <table>
                                <tr>
                                    <th>Name</th>
                                </tr>
                                <tr v-for="(item, index) in $page.props.clients.data" :key="index">
                                    <td>{{ item.name }}</td>
                                </tr>
                            </table> -->
                            <div class="overflow-x-auto my-8">
                                <table class="w-full border border-black">
                                    <thead class="bg-[#b8b8b8]">
                                        <tr class=" text-left">
                                            <th class="p-2 whitespace-nowrap text-xs w-[15%]">No.</th>
                                            <th class="p-2 whitespace-nowrap text-xs">Name</th>
                                            <!-- <th class="whitespace-nowrap text-xs">Action</th> -->
                                            <!-- <th class="whitespace-nowrap text-xs">スターテス</th>
                                            <th class="whitespace-nowrap text-xs text-center">アクション</th> -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(item, index) in $page.props.clients.data"
                                            :key="index"
                                            class="">
                                            <td class="p-2 w-[15%]">
                                                {{ index }}
                                            </td>
                                            <td class="p-2">
                                                {{ item.name }}
                                            </td>
                                            <!-- <td class="text-center">
                                                &nbsp;
                                                <Link class="btn btn-outline-primary py-1 px-2"
                                                        :href="route('client.destroy',item.id)">

                                                </Link>
                                            </td> -->
                                        </tr>
                                    </tbody>
                                </table>
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
