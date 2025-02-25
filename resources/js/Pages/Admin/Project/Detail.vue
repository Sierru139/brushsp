<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Project - Detail" />

        <template>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800"
            >
                Project Detail
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div
                    class="overflow-hidden bg-gray-100 shadow sm:rounded-lg"
                >

                    <div class="p-6 text-gray-900">
                        <h3 class="text-3xl mb-3">
                            <b>Project</b>
                        </h3>
                        <p class="mb-3 text-right">
                            <Link class="py-1 px-3 bg-gray-300 rounded" :href="route('project.index')">Back</Link>
                        </p>

                        <div class="">
                            <div class="">
                                <h2>Id : <br>{{$page.props.project.id}}</h2>
                                <br>
                                <h2>Slug : <br>{{$page.props.project.slug}}</h2>
                                <br>
                                <h2>Title : <br>{{$page.props.project.title}}</h2>
                                <br>
                                <div>
                                    <h2>Image : <br>{{$page.props.project.banner_img}}</h2>
                                    <img :src="'/storage/'+$page.props.project.banner_img" alt="" width="400" height="275">
                                </div>
                                <br>
                                <h2>Link : <br><a :href="$page.props.project.link" class="text-blue-500 hover:underline">{{$page.props.project.link}}</a></h2>
                                <br>
                                <h2>Client name : <br>{{$page.props.project.client.name_jp}} - {{$page.props.project.client.name_en}}</h2>
                                <br>
                                <h2>Team name : <br>{{$page.props.project.team.name}}</h2>
                                <br>
                                <h2>Project number : <br>{{$page.props.project.project_number}}</h2>
                                <br>
                                <div class="customHtml">
                                    Description : <br>
                                    <div v-html="convertToLink($page.props.project.description)"></div>
                                </div>
                                <br>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
</template>
<script>
export default {
    data() {
        return {
        inputText: "Cek informasi di https://example.com dan https://google.com",
        };
    },
    methods: {
        convertToLink(text) {
            if (!text) return "";
            const pattern = /(https?:\/\/[^\s<>]+)/g;
            return text.replace(pattern, '<a class="text-blue-500 hover:underline" href="$1" target="_blank">$1</a>');
        }
    },
};
</script>
<style>
.customHtml {
    all: revert !important;
}
</style>

