
<script setup>
import TaskFormCreate from "./Components/TaskFormCreate.vue";
import TaskList from './Components/TaskList.vue';
import { ref } from 'vue';

const newTask = ref(null);
const updateTaskList = (task) => {
    newTask.value = task;
};


</script>

<template>
    <div class="container">
        <div class="row">
            <div class="col">
            </div>
            <div class="col-10 pt-6">
                <h1 class="border-bottom mb-4 pb-2">Gestor de Tarea</h1>
                <TaskFormCreate @task-created="updateTaskList" class="mb-4 pb-2"/>
                <TaskList :newTask="newTask"/>
            </div>
            <div class="col">
            </div>
        </div>
    </div>
</template>