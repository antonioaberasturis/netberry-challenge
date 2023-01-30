<script setup>
import TaskRepository from '@/repositories/TaskRepository';

const props = defineProps(['task']);
const emit = defineEmits(['task-removed']);

const bgs = [
    'primary',
    'success',
    'danger',
];

const removeTask = () => {
    TaskRepository
        .delete(props.task.id)
        .then(response => {
            if(response.status === 204)
                emit('task-removed', props.task.id);
        })
        .catch(err => console.log(err));
};

</script>

<template>
    <tr>
        <td>{{ task.name }}</td>
        <td>
            <span :class="'badge text-bg-' + bgs[index]" v-for="(category, index) in task.categories" :key="category.id">
                {{ category.name }}
            </span>
        </td>
        <td>
            <button type="button" class="btn btn-outline-danger" @click="removeTask">X</button>
        </td>
    </tr>
</template>