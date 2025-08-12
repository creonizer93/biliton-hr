<script setup>
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
    import { Head } from '@inertiajs/vue3'
    import PrimaryButton from '@/Components/PrimaryButton.vue'
    import Form from './_Form.vue'

    defineProps({
        divisions: Array,
    })
</script>

<template>
    <Head title="Add Division" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">Add Division</h2>
            <div>
                <h1 class="text-2xl font-bold mb-4">Tambah Divisi</h1>
                <Form :division="{ name: '' }" button-text="Simpan" submit-url="/divisions" method="post" />
            </div>
        </template>
    </AuthenticatedLayout>
</template>
