<template>
    <form @submit.prevent="submit">
        <div class="mb-4">
            <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Nama Divisi</label>
            <input id="name" type="text" v-model="form.name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" />
            <div v-if="form.errors.name" class="text-red-500 text-sm mt-1">{{ form.errors.name }}</div>
        </div>

        <div>
            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                {{ buttonText }}
            </button>
        </div>
    </form>
</template>

<script setup>
    import { useForm } from '@inertiajs/vue3'

    const props = defineProps({
        division: {
            type: Object,
            default: () => ({ name: '' }),
        },
        buttonText: {
            type: String,
            default: 'Simpan',
        },
        submitUrl: String,
        method: {
            type: String,
            default: 'post', // 'post' atau 'put'
        },
    })

    const form = useForm({
        name: props.division.name,
    })

    const submit = () => {
        if (props.method === 'post') {
            form.post(props.submitUrl)
        } else {
            form.put(props.submitUrl)
        }
    }
</script>
