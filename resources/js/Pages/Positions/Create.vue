<script setup>
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
    import { Head } from '@inertiajs/vue3'
    import Form from './_Form.vue'

    defineProps({
        positions: Array,
    })
</script>

<template>
    <Head title="Add Positions" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">Add Position</h2>
            <div>
                <Form :position="{ name: '' }" button-text="Simpan" submit-url="/positions" method="post" />
            </div>
        </template>
    </AuthenticatedLayout>
</template>
