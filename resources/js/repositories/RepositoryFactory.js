import CategoryRepository from './CategoryRepository';
import TaskRepository from './TaskRepository';

const repositories = {
    category: CategoryRepository,
    task: TaskRepository
};

export const RepositoryFactory = {
    get: name => repositories[name]
};