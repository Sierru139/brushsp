<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm, usePage, Link} from '@inertiajs/vue3';
const date = new Date().toLocaleDateString('en-IN', { timeZone: 'Asia/Tokyo' })

</script>

<script>
import AdminNavbar from '@/Components/AdminNavbar.vue';
export default {
        data() {
            return {
            isMenuOpen: false,
            dateTime: ''
            };
        },
        mounted() {
            setInterval(()=>{
                    this.dateTime = new Date().toLocaleTimeString('en-US', { timeZone: 'Asia/Tokyo', hour12: false})
                }, 300)
        },
        methods: {
            toggleMenu() {
            this.isMenuOpen = !this.isMenuOpen;
            }
        }
    };
</script>

<template>
    <Head title="Dashboard" />

    <div class="lg:flex">
        <AdminNavbar></AdminNavbar>
        <div class="w-full bg-gray-200">
            <Link :href="route('logout')" class="text-right block pr-10 pt-5 absolute right-0">Log Out</Link>
            <div class="text-center pb-6 pt-10">
                <span class="text-6xl text-gray-700">
                    {{ dateTime }}
                </span>
                <br>
                <span class="anu1 text-xl text-gray-700">
                    {{ date }}
                </span>
            </div>

            <div class="my-3 text-center">
                <p>Hallo {{ $page.props.user.name }} !</p>
            </div>

            <div class="flex flex-wrap w-full py-6 gap-y-4">
                <div class="lg:flex-[33.3333%] flex-[50%] lg:grow-0 grow px-2">
                    <div class="flex p-6 bg-white rounded-xl border text-gray-700 items-center">
                        <div class="pr-4 ">
                            <i class="fa-solid fa-project-diagram text-3xl"></i>
                        </div>
                        <div class="grow">
                            <h3 class="text-2xl font-bold">{{ $page.props.totalProject }}</h3>
                            <p class="sm:text-sm text-xs opacity-70">Project</p>
                        </div>
                    </div>
                </div>
                <div class="lg:flex-[33.3333%] flex-[50%] lg:grow-0 grow px-2">
                    <div class="flex p-6 bg-white rounded-xl border text-gray-700 items-center">
                        <div class="pr-4 ">
                            <i class="fa-solid fa-building text-3xl"></i>
                        </div>
                        <div class="grow">
                            <h3 class="text-2xl font-bold">{{ $page.props.totalClient }}</h3>
                            <p class="sm:text-sm text-xs opacity-70">Client</p>
                        </div>
                    </div>
                </div>
                <div class="lg:flex-[33.3333%] flex-[50%] lg:grow-0 grow px-2">
                    <div class="flex p-6 bg-white rounded-xl border text-gray-700 items-center">
                        <div class="pr-4 ">
                            <i class="fa-solid fa-users text-3xl"></i>
                        </div>
                        <div class="grow">
                            <h3 class="text-2xl font-bold">{{ $page.props.totalTeam }}</h3>
                            <p class="sm:text-sm text-xs opacity-70">Team</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<style>
/*.anu1 {
    @apply font-bold text-2xl
}*/
</style>
