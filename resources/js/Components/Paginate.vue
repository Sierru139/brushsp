<script setup>
import { Link } from '@inertiajs/vue3';
</script>

<style scoped>
.active-link {
    background-color: #38c67e;
}
</style>

<template>
    <div class="flex items-center justify-between border-t border-gray-200 px-4 py-3 sm:px-6">
        <div class="sm:flex sm:flex-1 sm:items-center sm:justify-between">
            <!-- Pagination Info -->
            <div>
                <p class="text-sm text-gray-700">
                    Showing
                    <span class="font-medium">{{ pageDetail.from }}</span>
                    to
                    <span class="font-medium">{{ pageDetail.to }}</span>
                    of
                    <span class="font-medium">{{ pageDetail.total }}</span>
                    results
                </p>
            </div>

            <!-- Pagination Links -->
            <div>
                <nav class="isolate inline-flex -space-x-px rounded-md shadow-sm" aria-label="Pagination">
                    <template v-for="(link, p) in links" :key="p">
                        <!-- Disabled Links -->
                        <div
                            v-if="link.url === null"
                            class="mr-1 mb-1 px-4 py-3 text-sm leading-4 text-gray-400 border rounded"
                            v-html="link.label"
                        />
                        <!-- Active and Inactive Links -->
                        <Link
                            v-else
                            class="mr-1 mb-1 px-4 py-3 text-sm leading-4 border rounded focus:border-indigo-500 focus:text-indigo-500"
                            :class="{ 'active-link text-white': link.active }"
                            :href="link.url"
                            v-html="link.label"
                        />
                    </template>
                </nav>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        links: {
            type: Array,
            required: true,
        },
        pageDetail: {
            type: Object, // Corrected to object
            required: true,
        },
    },
};
</script>

