<script setup>
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
    import { Head, useForm } from '@inertiajs/vue3'
    import PrimaryButton from '@/Components/PrimaryButton.vue'
    import Form from './_Form.vue'

    const { clusters } = defineProps({
        clusters: Object,
    })

    const form = useForm({
        name: clusters.name,
    })
</script>

<template>
    <Head title="Edit Clusters" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">Edit Cluster</h2>
            <div>
                <Form :cluster="clusters" button-text="Update" :submit-url="`/clusters/${clusters.id}`" method="put" />
            </div>
        </template>
    </AuthenticatedLayout>
</template>
