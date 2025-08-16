<script setup>
    import { ref, watch } from 'vue'
    import dayjs from 'dayjs'

    const props = defineProps({
        modelValue: String, // format dari DB (ISO)
    })
    const emit = defineEmits(['update:modelValue'])

    const internal = ref('')

    watch(
        () => props.modelValue,
        (val) => {
            internal.value = val ? dayjs(val).format('YYYY-MM-DD') : ''
        },
        { immediate: true }
    )

    function updateValue(e) {
        const val = e.target.value
        emit('update:modelValue', val) // simpan tetap format ISO (YYYY-MM-DD)
    }
</script>

<template>
    <input type="date" :value="internal" @input="updateValue" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
    <!-- <p v-if="internal" class="mt-1 text-sm text-gray-500">( {{ dayjs(internal).format('DD/MM/YYYY') }} )</p> -->
</template>
