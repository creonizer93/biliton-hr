<script setup>
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
    import { Head } from '@inertiajs/vue3'
    import Form from './_Form.vue'

    defineProps({
        clusters: Array,
    })
</script>

<template>
    <Head title="Add Cluster" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">Add Cluster</h2>
            <div>
                <Form :cluster="{ name: '' }" button-text="Simpan" submit-url="/clusters" method="post" />
            </div>
        </template>
    </AuthenticatedLayout>
</template>
