<script setup>
import { computed } from 'vue';

const emit = defineEmits(['update-checked']);

const props = defineProps({
    checked: {
        type: [Array, Boolean],
        default: false,
    },
    value: {
        default: null,
    },
    label: {
        default: '',
    },
});

const proxyChecked = computed({
    get() {
        return props.checked;
    },

    set(val) {
        emit('update-checked', {id: props.value, name: props.label, checked: val});
    },
});
</script>

<template>
    <div class="col">
        <div class="form-check">
            <input
                type="checkbox"
                v-model="proxyChecked"
                class="form-check-input"
            />
            <label class="form-check-label" for="inlineFormCheck">{{ label }}</label>
        </div>
    </div>
</template>
