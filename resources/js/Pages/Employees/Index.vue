<script setup>
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
    import { Head } from '@inertiajs/vue3'
    import PrimaryButton from '@/Components/PrimaryButton.vue'
    import Pagination from '@/Components/Pagination.vue'
    import dayjs from 'dayjs'

    defineProps({
        employees: Object,
    })
</script>

<template>
    <Head title="Employees" />

    <AuthenticatedLayout>
        <!-- <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">Employees</h2>
        </template> -->

        <div class="py-5">
            <div class="w-full">
                <div class="overflow-x-auto bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <!-- Tombol Create -->
                        <PrimaryButton>
                            <a href="/employees/create" class="text-white">Add Employees</a>
                        </PrimaryButton>

                        <!-- Flash message -->
                        <div v-if="$page.props.flash.success" class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mt-4" role="alert">
                            {{ $page.props.flash.success }}
                        </div>
                        <div v-if="$page.props.flash.error" class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mt-4" role="alert">
                            {{ $page.props.flash.error }}
                        </div>

                        <!-- Table -->
                        <table class="min-w-full text-xs text-gray-700 mt-2">
                            <thead class="bg-gray-100 text-gray-600 uppercase tracking-wider">
                                <tr>
                                    <th class="px-4 py-2">#</th>
                                    <th class="px-4 py-2">Nama</th>
                                    <th class="px-4 py-2">NIK KTP</th>
                                    <th class="px-4 py-2">NIK Karyawan</th>
                                    <th class="px-4 py-2">Tempat Lahir</th>
                                    <th class="px-4 py-2">Tanggal Lahir</th>
                                    <th class="px-4 py-2">Alamat KTP</th>
                                    <th class="px-4 py-2">Alamat Domisili</th>
                                    <th class="px-4 py-2">No. HP</th>
                                    <th class="px-4 py-2">Email</th>
                                    <th class="px-4 py-2">Divisi</th>
                                    <th class="px-4 py-2">Cluster</th>
                                    <th class="px-4 py-2">Posisi</th>
                                    <th class="px-4 py-2">Status</th>
                                    <th class="px-4 py-2">Tanggal Masuk</th>
                                    <th class="px-4 py-2">Tanggal Keluar</th>
                                    <th class="px-4 py-2">No. Rekening</th>
                                    <th class="px-4 py-2">Bank</th>
                                    <th class="px-4 py-2">No. BPJS Kesehatan</th>
                                    <th class="px-4 py-2">Tanggal Terdaftar</th>
                                    <th class="px-4 py-2">No. BPJS TK</th>
                                    <th class="px-4 py-2">Tanggal Terdaftar</th>
                                    <th class="px-4 py-2">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(employee, index) in employees.data" :key="index" class="hover:bg-gray-50">
                                    <td class="border px-4 py-2">
                                        {{ ++index }}
                                    </td>
                                    <td class="border px-4 py-2">
                                        {{ employee.full_name }}
                                    </td>
                                    <td class="border px-4 py-2">
                                        {{ employee.ktp_number }}
                                    </td>
                                    <td class="border px-4 py-2">
                                        {{ employee.employee_code }}
                                    </td>
                                    <td class="border px-4 py-2">
                                        {{ employee.birth_place }}
                                    </td>
                                    <td class="border px-4 py-2">
                                        {{ dayjs(employee.birth_date).format('DD/MM/YYYY') }}
                                    </td>
                                    <td class="border px-4 py-2">
                                        {{ employee.address_ktp }}
                                    </td>
                                    <td class="border px-4 py-2">
                                        {{ employee.address_domicile }}
                                    </td>
                                    <td class="border px-4 py-2">
                                        {{ employee.phone_number }}
                                    </td>
                                    <td class="border px-4 py-2">
                                        {{ employee.email }}
                                    </td>
                                    <td class="border px-4 py-2">
                                        {{ employee.division?.name }}
                                    </td>
                                    <td class="border px-4 py-2">
                                        {{ employee.cluster?.name }}
                                    </td>
                                    <td class="border px-4 py-2">
                                        {{ employee.position?.name }}
                                    </td>
                                    <td class="border px-4 py-2">
                                        {{ employee.status_employee }}
                                    </td>
                                    <td class="border px-4 py-2">
                                        {{ dayjs(employee.join_date).format('DD/MM/YYYY') }}
                                    </td>
                                    <td class="border px-4 py-2">
                                        {{ employee.resign_date ? dayjs(employee.resign_date).format('DD/MM/YYYY') : '-' }}
                                    </td>
                                    <td class="border px-4 py-2">
                                        {{ employee.bank_account_number }}
                                    </td>
                                    <td class="border px-4 py-2">
                                        {{ employee.bank_name }}
                                    </td>
                                    <td class="border px-4 py-2">
                                        {{ employee.bpjs_health_number }}
                                    </td>
                                    <td class="border px-4 py-2">
                                        {{ dayjs(employee.bpjs_health_join_date).format('DD/MM/YYYY') }}
                                    </td>
                                    <td class="border px-4 py-2">
                                        {{ employee.bpjs_tk_number }}
                                    </td>
                                    <td class="border px-4 py-2">
                                        {{ dayjs(employee.bpjs_tk_join_date).format('DD/MM/YYYY') }}
                                    </td>
                                    <td class="border px-4 py-2">
                                        <a :href="`/employees/${employee.id}/edit`" class="text-blue-500 hover:underline">Edit</a>
                                        <form :action="`/employees/${employee.id}`" method="POST" class="inline">
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
                    <Pagination :links="employees.links" :from="employees.from" :to="employees.to" :total="employees.total" />
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
