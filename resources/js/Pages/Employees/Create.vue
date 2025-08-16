<script setup>
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
    import { Head, useForm } from '@inertiajs/vue3'
    import DateInput from '@/Components/DateInput.vue'
    import PrimaryButton from '@/Components/PrimaryButton.vue'
    import dayjs from 'dayjs'
    import { ref } from 'vue'

    const props = defineProps({
        divisions: Array,
        clusters: Array,
        positions: Array,
        insurances: Array,
    })

    const form = useForm({
        full_name: '',
        ktp_number: '',
        employee_code: '',
        birth_place: '',
        birth_date: '',
        address_ktp: '',
        address_domicile: '',
        phone_number: '',
        email: '',
        division_id: '',
        cluster_id: '',
        position_id: '',
        status_employee: 'active',
        join_date: '',
        resign_date: '',
        bank_account_number: '',
        bank_name: '',
        insurance_id: '',
        bpjs_health_number: '',
        bpjs_health_join_date: '',
        bpjs_tk_number: '',
        bpjs_tk_join_date: '',
    })

    const submit = () => {
        form.post(route('employees.store'))
    }
</script>

<template>
    <Head title="Create Employee" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between items-center">
                <h2 class="text-xl font-semibold text-gray-800">Create Employee</h2>
                <button @click="submit" :disabled="form.processing" class="px-4 py-2 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-700 disabled:opacity-50">Save</button>
            </div>
        </template>

        <div class="py-6">
            <div class="max-w-7xl mx-auto space-y-6">
                <!-- Personal Info -->
                <div class="bg-white shadow rounded-xl p-6">
                    <h3 class="text-lg font-semibold text-gray-700 mb-4">Personal Information</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium">Full Name</label>
                            <input v-model="form.full_name" type="text" class="mt-1 block w-full rounded-lg border-gray-300" />
                        </div>
                        <div>
                            <label class="block text-sm font-medium">KTP Number</label>
                            <input v-model="form.ktp_number" type="text" class="mt-1 block w-full rounded-lg border-gray-300" />
                        </div>
                        <div>
                            <label class="block text-sm font-medium">Employee Code</label>
                            <input v-model="form.employee_code" type="text" class="mt-1 block w-full rounded-lg border-gray-300" />
                        </div>
                        <div>
                            <label class="block text-sm font-medium">Birth Place</label>
                            <input v-model="form.birth_place" type="text" class="mt-1 block w-full rounded-lg border-gray-300" />
                        </div>
                        <div>
                            <label class="block text-sm font-medium">Birth Date</label>
                            <input v-model="form.birth_date" type="date" class="mt-1 block w-full rounded-lg border-gray-300" />
                        </div>
                        <div>
                            <label class="block text-sm font-medium">Phone Number</label>
                            <input v-model="form.phone_number" type="text" class="mt-1 block w-full rounded-lg border-gray-300" />
                        </div>
                        <div>
                            <label class="block text-sm font-medium">Email</label>
                            <input v-model="form.email" type="email" class="mt-1 block w-full rounded-lg border-gray-300" />
                        </div>
                        <div>
                            <label class="block text-sm font-medium">Address (KTP)</label>
                            <input v-model="form.address_ktp" type="text" class="mt-1 block w-full rounded-lg border-gray-300" />
                        </div>
                        <div>
                            <label class="block text-sm font-medium">Address (Domicile)</label>
                            <input v-model="form.address_domicile" type="text" class="mt-1 block w-full rounded-lg border-gray-300" />
                        </div>
                    </div>
                </div>

                <!-- Employment Info -->
                <div class="bg-white shadow rounded-xl p-6">
                    <h3 class="text-lg font-semibold text-gray-700 mb-4">Employment Information</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium">Division</label>
                            <select v-model="form.division_id" class="mt-1 block w-full rounded-lg border-gray-300">
                                <option value="">Select Division</option>
                                <option v-for="division in divisions" :key="division.id" :value="division.id">{{ division.name }}</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium">Cluster</label>
                            <select v-model="form.cluster_id" class="mt-1 block w-full rounded-lg border-gray-300">
                                <option value="">Select Cluster</option>
                                <option v-for="cluster in clusters" :key="cluster.id" :value="cluster.id">{{ cluster.name }}</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium">Position</label>
                            <select v-model="form.position_id" class="mt-1 block w-full rounded-lg border-gray-300">
                                <option value="">Select Position</option>
                                <option v-for="position in positions" :key="position.id" :value="position.id">{{ position.name }}</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium">Status</label>
                            <select v-model="form.status_employee" class="mt-1 block w-full rounded-lg border-gray-300">
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                                <option value="freelance">Freelance</option>
                                <option value="resigned">Resigned</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium">Join Date</label>
                            <DateInput v-model="form.join_date" type="date" class="mt-1 block w-full rounded-lg border-gray-300" />
                        </div>
                        <div>
                            <label class="block text-sm font-medium">Resign Date</label>
                            <input v-model="form.resign_date" type="date" class="mt-1 block w-full rounded-lg border-gray-300" />
                        </div>
                        <div>
                            <label class="block text-sm font-medium">Bank Account Number</label>
                            <input v-model="form.bank_account_number" type="text" class="mt-1 block w-full rounded-lg border-gray-300" />
                        </div>
                        <div>
                            <label class="block text-sm font-medium">Bank Name</label>
                            <input v-model="form.bank_name" type="text" class="mt-1 block w-full rounded-lg border-gray-300" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
