<script setup>
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
    import { Head, useForm } from '@inertiajs/vue3'
    import PrimaryButton from '@/Components/PrimaryButton.vue'
    import Form from './_Form.vue'

    const { divisions } = defineProps({
        divisions: Object,
    })

    const form = useForm({
        name: divisions.name,
    })
</script>

<template>
    <Head title="Edit Division" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">Edit Division</h2>
            <div>
                <Form :division="divisions" button-text="Update" :submit-url="`/divisions/${divisions.id}`" method="put" />
            </div>
        </template>
    </AuthenticatedLayout>
</template>
