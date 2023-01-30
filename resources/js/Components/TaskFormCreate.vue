<script setup>
import { onMounted, ref } from 'vue';
import { v4 as uuid } from 'uuid';
import CategoryRepository from '../repositories/CategoryRepository';
import TaskRepository from '../repositories/TaskRepository';
import Checkbox from './Checkbox.vue'

const emit = defineEmits(['task-created']);

let newTask = null;
const form = ref(null);
let categorySelecteds = [];

const categories = ref(null);
const taskName = ref('');
const formValidated = ref(true);

const getCategories = () => {
    CategoryRepository.get()
        .then(response => categories.value = response.data)
        .catch(err => console.log(err));
};

const createTask = () => {
    if(!categorySelecteds.length || !taskName.value){
        formValidated.value = false;
        return false;
    }

    newTask = {
                id: uuid(), 
                name: taskName.value, 
                categoryIds: categorySelecteds.map((item) => item.id)
            };
    TaskRepository.post(newTask)
        .then(response => {
            if(response.status === 201){
                emitTaskCreated(newTask);
                formReset();
            }
        })
        .catch(err => console.log(err));
};

const emitTaskCreated = (task) => {
    emit('task-created', {
        id: task.id, 
        name: task.name, 
        categories: categorySelecteds
    });
};

const formReset = () => {
    categorySelecteds = [];
    form.value.reset();
};

const onUpdateCheckbox = (checkbox) => {
    if(checkbox.checked) 
        categorySelecteds.push(checkbox);
    else 
        categorySelecteds = categorySelecteds.filter((item) => item.id !== checkbox.id);
}

onMounted(() => {
    getCategories();
});
</script>

<template>
    <form @submit.prevent="createTask" ref="form" class="row row-cols-lg-auto g-3 align-items-center">
    

        <div class="col-md-6">
            <input type="text" class="form-control" name="task_name" v-model="taskName" required>
        </div>
        <div class="col" v-if="!categories">
            <label class="form-control">Cargando...</label>
        </div>
        <Checkbox 
            class="col"
            @update-checked="onUpdateCheckbox" 
            v-for="category of categories" 
            :key="category.id" 
            :value="category.id" 
            :label="category.name" 
            :checked="false"
        />
        <div class="col">
            <button type="submit" class="form-control btn btn-primary">Añadir</button>
        </div>
    </form>

</template>