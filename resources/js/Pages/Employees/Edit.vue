<script setup>
    import DateInput from '@/Components/DateInput.vue'
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
    import { Head, useForm } from '@inertiajs/vue3'
    import dayjs from 'dayjs'
    import { ref } from 'vue'

    const props = defineProps({
        employee: Object,
        insurances: Object,
        divisions: Array,
        clusters: Array,
        positions: Array,
    })

    const form = useForm({
        ...props.employee,
    })
    function submit() {
        form.put(route('employees.update', props.employee.id))
    }
    console.log(form)
</script>

<template>
    <Head title="Edit Employee" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-semibold leading-tight text-gray-800">Edit Employee</h2>
                <div>
                    <button @click="submit" class="px-4 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700" :disabled="form.processing">Save Changes</button>
                    <button @click="$inertia.get(`/employees/${employee.id}`)" class="ml-2 px-4 py-2 rounded-lg bg-gray-600 text-white hover:bg-gray-700">Back</button>
                </div>
            </div>
        </template>

        <div class="py-6 space-y-6 max-w-5xl mx-auto">
            <!-- Personal Info -->
            <div class="bg-white shadow rounded-2xl p-6">
                <h3 class="text-lg font-semibold mb-4">Personal Info</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium">Full Name</label>
                        <input v-model="form.full_name" type="text" class="mt-1 block w-full rounded-lg border-gray-300" />
                    </div>
                    <div>
                        <label class="block text-sm font-medium">NIK KTP</label>
                        <input v-model="form.ktp_number" type="text" class="mt-1 block w-full rounded-lg border-gray-300" />
                    </div>
                    <div>
                        <label class="block text-sm font-medium">NIK Karyawan</label>
                        <input v-model="form.employee_code" type="text" class="mt-1 block w-full rounded-lg border-gray-300" />
                    </div>
                    <div>
                        <label class="block text-sm font-medium">Alamat KTP</label>
                        <input v-model="form.address_ktp" type="text" class="mt-1 block w-full rounded-lg border-gray-300" />
                    </div>
                    <div>
                        <label class="block text-sm font-medium">Alamat Domisili</label>
                        <input v-model="form.address_domicile" type="text" class="mt-1 block w-full rounded-lg border-gray-300" />
                    </div>
                    <div>
                        <label class="block text-sm font-medium">Templat Lahir</label>
                        <input v-model="form.birth_place" type="text" class="mt-1 block w-full rounded-lg border-gray-300" />
                    </div>
                    <div>
                        <label class="block text-sm font-medium">Tanggal Lahir</label>
                        <DateInput v-model="form.birth_date" type="date" class="mt-1 block w-full rounded-lg border-gray-300" />
                    </div>
                    <div>
                        <label class="block text-sm font-medium">No. Telp</label>
                        <input v-model="form.phone_number" type="text" class="mt-1 block w-full rounded-lg border-gray-300" />
                    </div>

                    <div>
                        <label class="block text-sm font-medium">Email</label>
                        <input v-model="form.email" type="email" class="mt-1 block w-full rounded-lg border-gray-300" />
                    </div>
                </div>
            </div>

            <!-- Employment Info -->
            <div class="bg-white shadow rounded-2xl p-6">
                <h3 class="text-lg font-semibold mb-4">Employment Info</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium">Division</label>
                        <select v-model="form.division_id" class="mt-1 block w-full rounded-lg border-gray-300">
                            <option value="">Select Division</option>
                            <option v-for="division in props.divisions" :key="division.id" :value="division.id">{{ division.name }}</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium">Cluster</label>
                        <select v-model="form.cluster_id" class="mt-1 block w-full rounded-lg border-gray-300">
                            <option value="">Select Cluster</option>
                            <option v-for="cluster in props.clusters" :key="cluster.id" :value="cluster.id">{{ cluster.name }}</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium">Position</label>
                        <select v-model="form.position_id" class="mt-1 block w-full rounded-lg border-gray-300">
                            <option value="">Select Position</option>
                            <option v-for="position in props.positions" :key="position.id" :value="position.id">{{ position.name }}</option>
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
                        <label>Join Date</label>
                        <DateInput v-model="form.join_date" type="date" class="mt-1 block w-full rounded-lg border-gray-300" />
                    </div>
                    <div>
                        <label>Resign Date</label>
                        <DateInput v-model="form.resign_date" type="date" class="mt-1 block w-full rounded-lg border-gray-300" />
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
