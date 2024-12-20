<script setup>
import { Head, Link } from '@inertiajs/vue3';
</script>
<script>
import AdminNavbar from '@/Components/AdminNavbar.vue'
</script>
<template>
    <Head title="Dashboard Class" />
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
                                <div class="w-[380px] h-[420px] p-2">
                                    <div class="bg-gray-300 mt-2 px-4 py-2 h-full rounded shadow flex flex-col justify-center items-center">
                                        <img src="/images/icon/add_button.png" class="mb-3 h-[200px] w-[200px] mx-auto opacity-60">
                                        <h3 class="text-xl">Add New Project</h3>
                                    </div>
                                </div>
                            </Link>
                            <div class="w-[380px] p-2" v-for="(item, index) in $page.props.project" :key="index">
                                <div class="bg-gray-300 mt-2 px-4 py-2 rounded shadow">
                                    <img :src="'/storage/'+item.banner_img" class="mb-3 h-[300px] w-full ">
                                    <div class="flex justify-between mb-1">
                                        <p>{{ item.type }}</p>
                                        <p>{{ item.start_date }}</p>
                                    </div>
                                    <h3 class="text-xl">{{ item.title }}</h3>
                                    <p>{{ item.slug }}</p>
                                    <!-- <p>{{ item.description }}</p> -->
                                    <p>{{ item.price }}</p>
                                    <div class="space-x-2">
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

                    </div>
                </div>
            </div>
        </div>
</template>
