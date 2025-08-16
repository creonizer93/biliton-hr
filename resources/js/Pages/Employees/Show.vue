<script setup>
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
    import { Head } from '@inertiajs/vue3'
    import PrimaryButton from '@/Components/PrimaryButton.vue'
    import dayjs from 'dayjs'

    const props = defineProps({
        employee: {
            type: Object,
            required: true,
        },
    })
</script>

<template>
    <Head title="Employee Details" />

    <AuthenticatedLayout>
        <div class="py-8">
            <div class="w-full max-w-6xl mx-auto">
                <div class="bg-white shadow rounded-2xl p-6">
                    <!-- Header -->
                    <div class="flex justify-between items-center border-b pb-4 mb-6">
                        <h2 class="text-2xl font-bold text-gray-800">Employee Details</h2>
                        <div class="flex gap-2">
                            <PrimaryButton @click.prevent="$inertia.get(`/employees/${props.employee.id}/edit`)" class="bg-green-500 hover:bg-green-600">Edit</PrimaryButton>
                            <PrimaryButton @click.prevent="$inertia.delete(`/employees/${props.employee.id}`)" class="bg-red-500 hover:bg-red-600">Delete</PrimaryButton>
                            <PrimaryButton class="bg-gray-600 hover:bg-gray-700">
                                <a href="/employees" class="text-white">Back</a>
                            </PrimaryButton>
                        </div>
                    </div>

                    <!-- Grid Data -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <!-- Personal Information -->
                        <div>
                            <h3 class="text-lg font-semibold text-gray-700 mb-3">Personal Information</h3>
                            <div class="space-y-2 text-sm text-gray-700">
                                <p>
                                    <span class="font-medium">Nama:</span>
                                    {{ props.employee.full_name }}
                                </p>
                                <p>
                                    <span class="font-medium">NIK KTP:</span>
                                    {{ props.employee.ktp_number }}
                                </p>
                                <p>
                                    <span class="font-medium">NIK Karyawan:</span>
                                    {{ props.employee.employee_code }}
                                </p>
                                <p>
                                    <span class="font-medium">Tempat Lahir:</span>
                                    {{ props.employee.birth_place || '-' }}
                                </p>
                                <p>
                                    <span class="font-medium">Tanggal Lahir:</span>
                                    {{ props.employee.birth_date ? dayjs(props.employee.birth_date).format('DD/MM/YYYY') : '-' }}
                                </p>
                                <p>
                                    <span class="font-medium">Alamat KTP:</span>
                                    {{ props.employee.address_ktp || '-' }}
                                </p>
                                <p>
                                    <span class="font-medium">Alamat Domisili:</span>
                                    {{ props.employee.address_domicile || '-' }}
                                </p>
                                <p>
                                    <span class="font-medium">No. HP:</span>
                                    {{ props.employee.phone_number || '-' }}
                                </p>
                                <p>
                                    <span class="font-medium">Email:</span>
                                    {{ props.employee.email || '-' }}
                                </p>
                            </div>
                        </div>

                        <!-- Employment Information -->
                        <div>
                            <h3 class="text-lg font-semibold text-gray-700 mb-3">Employment Information</h3>
                            <div class="space-y-2 text-sm text-gray-700">
                                <p>
                                    <span class="font-medium">Divisi:</span>
                                    {{ props.employee.division?.name || '-' }}
                                </p>
                                <p>
                                    <span class="font-medium">Cluster:</span>
                                    {{ props.employee.cluster?.name || '-' }}
                                </p>
                                <p>
                                    <span class="font-medium">Posisi:</span>
                                    {{ props.employee.position?.name || '-' }}
                                </p>
                                <p>
                                    <span class="font-medium">Status:</span>
                                    {{ props.employee.status_employee || '-' }}
                                </p>
                                <p>
                                    <span class="font-medium">Tanggal Masuk:</span>
                                    {{ props.employee.join_date ? dayjs(props.employee.join_date).format('DD/MM/YYYY') : '-' }}
                                </p>
                                <p>
                                    <span class="font-medium">Tanggal Keluar:</span>
                                    {{ props.employee.resign_date ? dayjs(props.employee.resign_date).format('DD/MM/YYYY') : '-' }}
                                </p>
                                <p>
                                    <span class="font-medium">No. Rekening:</span>
                                    {{ props.employee.bank_account_number || '-' }}
                                </p>
                                <p>
                                    <span class="font-medium">Bank:</span>
                                    {{ props.employee.bank_name || '-' }}
                                </p>
                            </div>
                        </div>

                        <!-- Insurance Information -->
                        <div class="md:col-span-2">
                            <h3 class="text-lg font-semibold text-gray-700 mb-3">Insurance Information</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-sm text-gray-700">
                                <div>
                                    <p>
                                        <span class="font-medium">No. BPJS Kesehatan:</span>
                                        {{ props.employee.insurance?.bpjs_health_number || '-' }}
                                    </p>
                                    <p>
                                        <span class="font-medium">Tanggal Terdaftar:</span>
                                        {{ props.employee.insurance?.bpjs_health_join_date ? dayjs(props.employee.insurance?.bpjs_health_join_date).format('DD/MM/YYYY') : '-' }}
                                    </p>
                                </div>
                                <div>
                                    <p>
                                        <span class="font-medium">No. BPJS TK:</span>
                                        {{ props.employee.insurance?.bpjs_tk_number || '-' }}
                                    </p>
                                    <p>
                                        <span class="font-medium">Tanggal Terdaftar:</span>
                                        {{ props.employee.insurance?.bpjs_tk_join_date ? dayjs(props.employee.insurance?.bpjs_tk_join_date).format('DD/MM/YYYY') : '-' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
