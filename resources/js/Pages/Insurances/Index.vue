<script setup>
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
    import { Head } from '@inertiajs/vue3'
    import PrimaryButton from '@/Components/PrimaryButton.vue'
    import Pagination from '@/Components/Pagination.vue'
    import dayjs from 'dayjs'
    import { ref, watch } from 'vue'
    import { usePage, router } from '@inertiajs/vue3'

    const props = defineProps({
        insurances: Object,
        employees: Object,
        divisions: Array,
        clusters: Array,
        filters: Object,
    })
    const search = ref(props.filters.search || '')
    const division_id = ref(props.filters.division_id || '')
    const cluster_id = ref(props.filters.cluster_id || '')
    const page = usePage()

    let sortField = ref(page.props.filters.sort_field || 'full_name')
    let sortDirection = ref(page.props.filters.sort_direction || 'asc')

    let timeout = null
    watch([search, division_id, cluster_id], () => {
        clearTimeout(timeout)
        timeout = setTimeout(() => {
            router.get(
                route('insurances.index'),
                {
                    search: search.value,
                    division_id: division_id.value,
                    cluster_id: cluster_id.value,
                },
                {
                    preserveState: true,
                    replace: true,
                }
            )
        }, 300)
    })

    function changeSort(field) {
        if (sortField.value === field) {
            sortDirection.value = sortDirection.value === 'asc' ? 'desc' : 'asc'
        } else {
            sortField.value = field
            sortDirection.value = 'asc'
        }
        router.get(
            route('insurances.index'),
            {
                ...page.props.filters,
                sort_field: sortField.value,
                sort_direction: sortDirection.value,
            },
            { preserveState: true, replace: true }
        )
    }
    // This will trigger the search and filter functionality when the user types in the search box or changes the dropdown selections.
    // The timeout is used to prevent too many requests being sent while the user is still typing
</script>

<template>
    <Head title="Insurances" />

    <AuthenticatedLayout>
        <div class="py-5">
            <div class="w-full">
                <div class="overflow-x-auto bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <!-- Tombol Create -->
                        <div class="flex justify-between items-center mb-4">
                            <!-- Tombol Create -->
                            <PrimaryButton>
                                <a href="/insurances/create" class="text-white">Add Insurances to Employee</a>
                            </PrimaryButton>

                            <!-- Filter Section -->
                            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-4">
                                <!-- Search -->
                                <div class="relative w-full sm:w-[278px]">
                                    <input v-model="search" type="text" placeholder="🔍 Search Nama, NIK or NIK Karyawan " class="w-full rounded-lg border border-gray-300 px-4 py-2 text-sm shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" />
                                </div>

                                <!-- Dropdown Filters -->
                                <div class="flex gap-2">
                                    <select v-model="division_id" class="rounded-lg border border-gray-300 bg-white px-3 pr-8 py-2 text-sm shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                        <option value="">All Divisions</option>
                                        <option v-for="d in divisions" :key="d.id" :value="d.id">{{ d.name }}</option>
                                    </select>

                                    <select v-model="cluster_id" class="rounded-lg border border-gray-300 bg-white px-3 pr-8 py-2 text-sm shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                        <option value="">All Clusters</option>
                                        <option v-for="c in clusters" :key="c.id" :value="c.id">{{ c.name }}</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Table -->
                        <table class="min-w-full text-xs text-gray-700 mt-2">
                            <thead class="bg-gray-100 text-gray-600 uppercase tracking-wider">
                                <tr>
                                    <th class="px-4 py-2">#</th>
                                    <th @click="changeSort('full_name')" class="cursor-pointer">Nama</th>
                                    <th class="px-4 py-2">NIK KTP</th>
                                    <th class="px-4 py-2">NIK Karyawan</th>
                                    <th @click="changeSort('division')" class="cursor-pointer">Divisi</th>
                                    <th @click="changeSort('cluster')" class="cursor-pointer">Cluster</th>
                                    <th class="px-4 py-2">Posisi</th>
                                    <th class="px-4 py-2">Status</th>
                                    <th class="px-4 py-2">No. BPJS Kesehatan</th>
                                    <th @click="changeSort('bpjs_health_join_date')" class="cursor-pointer">Tanggal Terdaftar</th>
                                    <th class="px-4 py-2">No. BPJS TK</th>
                                    <th class="px-4 py-2">Tanggal Terdaftar</th>
                                    <th class="px-4 py-2">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(insurance, index) in insurances.data" :key="index" class="hover:bg-gray-50">
                                    <td class="border px-4 py-2">
                                        {{ ++index }}
                                    </td>
                                    <td class="border px-4 py-2">
                                        {{ insurance.employee.full_name }}
                                    </td>
                                    <td class="border px-4 py-2">
                                        {{ insurance.employee.ktp_number }}
                                    </td>
                                    <td class="border px-4 py-2">
                                        {{ insurance.employee.employee_code }}
                                    </td>
                                    <td class="border px-4 py-2">
                                        {{ insurance.employee.division?.name }}
                                    </td>
                                    <td class="border px-4 py-2">
                                        {{ insurance.employee.cluster?.name }}
                                    </td>
                                    <td class="border px-4 py-2">
                                        {{ insurance.employee.position?.name }}
                                    </td>
                                    <td class="border px-4 py-2">
                                        {{ insurance.employee.status_employee }}
                                    </td>
                                    <td class="border px-4 py-2">
                                        {{ insurance.bpjs_health_number }}
                                    </td>
                                    <td class="border px-4 py-2">
                                        {{ dayjs(insurance.bpjs_health_join_date).format('DD/MM/YYYY') }}
                                    </td>
                                    <td class="border px-4 py-2">
                                        {{ insurance.bpjs_tk_number }}
                                    </td>
                                    <td class="border px-4 py-2">
                                        {{ dayjs(insurance.bpjs_tk_join_date).format('DD/MM/YYYY') }}
                                    </td>
                                    <td class="border px-4 py-2">
                                        <a :href="`/insurances/${insurance.id}/edit`" class="text-blue-500 hover:underline">Edit</a>
                                        <form :action="`/insurances/${insurance.id}`" method="POST" class="inline">
                                            <input type="hidden" name="_method" value="DELETE" />
                                            <input type="hidden" name="_token" :value="$page.props.auth.csrf_token" />
                                            <button type="submit" class="text-red-500 hover:underline ml-2">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- PAGINATION -->
                    <Pagination :links="insurances.links" :from="insurances.from" :to="insurances.to" :total="insurances.total" />
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
