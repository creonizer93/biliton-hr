<script setup>
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
    import { Head } from '@inertiajs/vue3'

    const props = defineProps({
        employeesByDivision: Array,
        employeesByCluster: Array,
    })
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">Dashboard</h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8 space-y-12">
                <!-- Section: Karyawan per Divisi -->
                <section>
                    <h3 class="text-lg font-bold mb-4">Jumlah Karyawan per Divisi</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                        <div v-for="item in employeesByDivision" :key="item.division_id" class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition">
                            <p class="text-gray-500">{{ item.division?.name ?? '–' }}</p>
                            <p class="text-3xl font-bold text-blue-600">{{ item.total }}</p>
                        </div>
                    </div>
                </section>

                <!-- Section: Karyawan per Cluster -->
                <section>
                    <h3 class="text-lg font-bold mb-4">Jumlah Karyawan per Cluster</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                        <div v-for="item in employeesByCluster" :key="item.cluster_id" class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition">
                            <p class="text-gray-500">{{ item.cluster?.name ?? '–' }}</p>
                            <p class="text-3xl font-bold text-green-600">{{ item.total }}</p>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
