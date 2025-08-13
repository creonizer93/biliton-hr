<script setup>
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
    import { Head, useForm } from '@inertiajs/vue3'
    import PrimaryButton from '@/Components/PrimaryButton.vue'
    import Form from './_Form.vue'

    const { positions } = defineProps({
        positions: Object,
    })

    const form = useForm({
        name: positions.name,
    })
</script>

<template>
    <Head title="Edit positions" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">Edit Position</h2>
            <div>
                <Form :position="positions" button-text="Update" :submit-url="`/positions/${positions.id}`" method="put" />
            </div>
        </template>
    </AuthenticatedLayout>
</template>
