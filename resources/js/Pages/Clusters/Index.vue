<script setup>
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
    import { Head } from '@inertiajs/vue3'
    import PrimaryButton from '@/Components/PrimaryButton.vue'

    defineProps({
        clusters: Array,
    })
</script>

<template>
    <Head title="Clusters" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">Clusters</h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <!-- Tombol Create -->
                        <PrimaryButton>
                            <a href="/clusters/create" class="text-white">Create Cluster</a>
                        </PrimaryButton>

                        <!-- Flash message -->
                        <div v-if="$page.props.flash.success" class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mt-4" role="alert">
                            {{ $page.props.flash.success }}
                        </div>

                        <table class="table-auto w-full mt-4">
                            <thead>
                                <tr>
                                    <th class="px-4 py-2">#</th>
                                    <th class="px-4 py-2">Cluster Name</th>
                                    <th class="px-4 py-2">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(cluster, index) in clusters" :key="index">
                                    <td class="border px-4 py-2">
                                        {{ ++index }}
                                    </td>
                                    <td class="border px-4 py-2">
                                        {{ cluster.name }}
                                    </td>
                                    <td class="border px-4 py-2">
                                        <PrimaryButton @click.prevent="$inertia.get(`/clusters/${cluster.id}/edit`)" class="bg-blue-500 hover:bg-blue-700">Edit</PrimaryButton>
                                        |
                                        <PrimaryButton @click.prevent="$inertia.delete(`/clusters/${cluster.id}`)" class="bg-red-500 hover:bg-red-700">Delete</PrimaryButton>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
