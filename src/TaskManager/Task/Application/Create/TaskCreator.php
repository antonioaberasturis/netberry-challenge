<?php

declare(strict_types=1);

namespace Netberry\TaskManager\Task\Application\Create;

use Netberry\TaskManager\Task\Domain\Task;
use Netberry\TaskManager\Task\Application\TaskData;
use Netberry\TaskManager\Task\Domain\TaskRepository;
use Netberry\TaskManager\Task\Domain\TaskAlreadyExistsException;
use Netberry\TaskManager\Category\Application\Checker\CategoryExistsCheckerByIdsService;
use Netberry\TaskManager\TaskCategory\Application\Create\TaskCategoryCreatorService;

class TaskCreator
{
    public function __construct(
        private TaskRepository $taskRepository,
        private CategoryExistsCheckerByIdsService $categoryChecker,
        private TaskCategoryCreatorService $taskCategoryCreator
    ){
    }

    public function __invoke(TaskData $taskData): void
    {
        $this->ensureTaskNotExists($taskData->getId());
        $this->ensureCategoriesExists($taskData->categoryIds());

        $task = new Task(
            id:     $taskData->getId(),
            name:   $taskData->getName(),
        );

        $this->taskRepository->save($task);

        $this->taskCategoryCreator->__invoke($taskData->getId(), $taskData->categoryIds());
    }

    private function ensureTaskNotExists(string $taskId): void
    {
        $task = $this->taskRepository->find($taskId);
        
        if(null !== $task) {
            throw new TaskAlreadyExistsException();
        }
    }

    private function ensureCategoriesExists(array $ids): void
    {
        $this->categoryChecker->__invoke($ids);
    }
}
