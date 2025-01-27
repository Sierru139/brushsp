<script setup>
import { Link } from '@inertiajs/vue3';
</script>

<script>
    export default {
        data() {
            return {
            isMenuOpen: false,
            };
        },
        mounted() {
        },
        methods: {
            toggleMenu() {
            this.isMenuOpen = !this.isMenuOpen;
            }
        }
    };
</script>
<template>
    <nav class="lg:max-w-[280px] max-lg:fixed top-0 h-full max-lg:w-full">
        <div class="max-lg:max-w-[1440px] max-lg:flex justify-between items-center mx-auto py-3 max-lg:px-2 border-gray-700 bg-gray-200 bg-opacity-80 backdrop-blur-md z-[999]">
            <!-- Logo -->
            <div class="lg:mb-4">
                <Link :href="route('admin.index')">
                    <img class="lg:w-48 w-32 max-sm:hidden mx-auto" src="/images/admin_assets/ruparaya-logo.png" alt="Logo">
                </Link>
                <Link :href="route('admin.index')">
                    <img class="w-16 sm:hidden mx-auto" src="/images/admin_assets/ruparaya-logo.png" alt="Logo">
                </Link>
        </div>

            <!-- Desktop Menu -->
            <div class="hidden lg:block py-3 rounded-3xl text-gray-800">
                <Link :href="route('admin.index')"
                       class="block py-4 px-3 font-semibold tracking-wide hover:text-gray-300 hover:bg-[#6f7583] duration-300"
                       :class="{ 'bg-[#375980] text-gray-50': $page.url === '/' }"
                       >
                       Home
                </Link>
                <Link :href="route('project.index')"
                       class="block py-4 px-3 font-semibold tracking-wide hover:text-gray-300 hover:bg-[#6f7583] duration-300"
                       :class="{ 'bg-[#375980] text-gray-50': $page.url === '/project' }"
                       >
                       Projects
                </Link>
                <Link :href="route('clients.index')"
                       class="block py-4 px-3 font-semibold tracking-wide hover:text-gray-300 hover:bg-[#6f7583] duration-300"
                       :class="{ 'bg-[#375980] text-gray-50': $page.url === '/clients' }"
                       >
                       Clients
                </Link>
                <Link :href="route('teams.index')"
                       class="block py-4 px-3 font-semibold tracking-wide hover:text-gray-300 hover:bg-[#6f7583] duration-300"
                       :class="{ 'bg-[#375980] text-gray-50': $page.url === '/teams' }"
                       >
                       Teams
                </Link>
                <Link :href="route('teams.index')"
                       class="block py-4 px-3 font-semibold tracking-wide hover:text-gray-300 hover:bg-[#6f7583] duration-300"
                       :class="{ 'bg-[#375980] text-gray-50': $page.url === '/project-code' }"
                       >
                       Project Code
                </Link>
                <!-- <Link :href="route('gallery.index')"
                       class="block py-4 px-3 font-semibold tracking-wide hover:text-gray-300 hover:bg-[#6f7583] duration-300"
                       :class="{ 'bg-[#375980] text-gray-50': $page.url === '/admin/gallery' }"
                       >
                       Galeri
                </Link>
                <Link :href="route('blog.index')"
                       class="block py-4 px-3 font-semibold tracking-wide hover:text-gray-300 hover:bg-[#6f7583] duration-300"
                       :class="{ 'bg-[#375980] text-gray-50': $page.url === '/admin/blog' }"
                       >
                       Berita
                </Link> -->
            </div>

            <!-- Contact Button (Always Visible) -->
            <div class="hidden lg:block text-gray-400 p-[20px] my-8">
                <img src="/images/admin_assets/brush-vec.png" alt="" class="">
            </div>

            <!-- Mobile Menu Icon -->
            <div class="lg:hidden text-gray-400" @click="toggleMenu">
                <button>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-8 h-8">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div v-if="isMenuOpen" class="lg:hidden bg-opacity-80 backdrop-blur-md border-gray-700">
            <div class="text-gray-800">
                <Link :href="route('admin.index')"
                       class="block py-4 px-3 font-semibold tracking-wide hover:text-gray-300 hover:bg-[#6f7583] duration-300"
                       :class="{ 'bg-[#375980] text-gray-50': $page.url === '/admin' }"
                       >
                       Home
                </Link>
                <Link :href="route('project.index')"
                       class="block py-4 px-3 font-semibold tracking-wide hover:text-gray-300 hover:bg-[#6f7583] duration-300"
                       :class="{ 'bg-[#375980] text-gray-50': $page.url === '/project' }"
                       >
                       Project
                </Link>
                <Link :href="route('clients.index')"
                       class="block py-4 px-3 font-semibold tracking-wide hover:text-gray-300 hover:bg-[#6f7583] duration-300"
                       :class="{ 'bg-[#375980] text-gray-50': $page.url === '/clients' }"
                       >
                       Clients
                </Link>
                <Link :href="route('teams.index')"
                       class="block py-4 px-3 font-semibold tracking-wide hover:text-gray-300 hover:bg-[#6f7583] duration-300"
                       :class="{ 'bg-[#375980] text-gray-50': $page.url === '/teams' }"
                       >
                       Teams
                </Link>
                <Link :href="route('teams.index')"
                       class="block py-4 px-3 font-semibold tracking-wide hover:text-gray-300 hover:bg-[#6f7583] duration-300"
                       :class="{ 'bg-[#375980] text-gray-50': $page.url === '/project-code' }"
                       >
                       Project Code
                </Link>
                <!-- <Link :href="route('gallery.index')"
                       class="block py-4 px-3 font-semibold tracking-wide hover:text-gray-300 hover:bg-[#6f7583] duration-300"
                       :class="{ 'bg-[#375980] text-gray-50': $page.url === '/admin/gallery' }"
                       >
                       Galeri
                </Link>
                <Link :href="route('blog.index')"
                       class="block py-4 px-3 font-semibold tracking-wide hover:text-gray-300 hover:bg-[#6f7583] duration-300"
                       :class="{ 'bg-[#375980] text-gray-50': $page.url === '/admin/blog' }"
                       >
                       Berita
                </Link> -->
            </div>
        </div>
    </nav>
</template>
