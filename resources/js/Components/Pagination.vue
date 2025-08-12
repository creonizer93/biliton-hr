<script setup>
    import { Link } from '@inertiajs/vue3'

    defineProps({
        links: Array,
        from: Number,
        to: Number,
        total: Number,
    })
</script>
<template>
    <div v-if="links.length > 3" class="flex flex-col items-center gap-2">
        <!-- Info jumlah data -->
        <div v-if="from && to && total" class="text-sm text-gray-500">Showing {{ from }} to {{ to }} of {{ total }} results</div>

        <!-- Links -->
        <div class="flex flex-wrap -mb-1">
            <template v-for="(link, key) in links" :key="key">
                <div v-if="link.url === null" class="mr-1 mb-1 px-4 py-2 text-sm leading-4 text-gray-400 border rounded" v-html="link.label"></div>

                <Link v-else class="mr-1 mb-1 px-4 py-2 text-sm leading-4 border rounded hover:bg-gray-100 focus:border-indigo-500 focus:text-indigo-500" :class="{ 'bg-indigo-500 text-white': link.active }" :href="link.url" v-html="link.label"></Link>
            </template>
        </div>
    </div>
</template>
