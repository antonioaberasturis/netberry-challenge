<script setup>
import TaskRepository from '@/repositories/TaskRepository';

const props = defineProps(['taskId']);
const emit = defineEmits(['task-removed']);

const removeTask = () => {
    TaskRepository
        .delete(props.taskId)
        .then(response => {
            if(response.status === 204)
                emit('task-removed', props.taskId);
        })
        .catch(err => console.log(err));
};

</script>

<template>
    <button type="button" class="btn btn-outline-danger" @click="removeTask">X</button>
</template>