<script setup>
import TaskItem from "./TaskItem.vue";
import { onMounted, ref, watch} from 'vue';
import TaskRepository from "@/repositories/TaskRepository";

const props = defineProps(['newTask']);
const tasks = ref([]);

const getTasks = async () => {
    await TaskRepository.get()
        .then(response => tasks.value = response.data)
        .catch(err => console.log(err.message));
};

const removeTaskById = (taskId) => {
    tasks.value = tasks.value.filter((task) => task.id !== taskId);
};

watch(
    () => props.newTask, 
    (newTask) => tasks.value = [...tasks.value, newTask]
);

onMounted(() => {
    getTasks();
});

</script>

<template>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th scope="col">Tareas</th>
                <th scope="col">Categorias</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody v-if="tasks && tasks.length">
            <TaskItem  @task-removed="removeTaskById" :task="task"  v-for="task in tasks" :key="task.id"/>
        </tbody>
    </table>
</template>