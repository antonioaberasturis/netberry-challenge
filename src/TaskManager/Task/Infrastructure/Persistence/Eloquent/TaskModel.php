<?php

declare(strict_types=1);

namespace Netberry\TaskManager\Task\Infrastructure\Persistence\Eloquent;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Netberry\TaskManager\Task\Domain\Task;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Netberry\TaskManager\Category\Infrastructure\Persistence\Eloquent\CategoryModel;
use Netberry\TaskManager\Task\Infrastructure\Persistence\Eloquent\TaskModelCollection;
use Netberry\TaskManager\Category\Infrastructure\Persistence\Eloquent\CategoryModelCollection;

class TaskModel extends Model
{
    use HasFactory;

    protected $table = 'tasks';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;
    protected $fillable = [
        'id',
        'name',
    ];

    protected $casts = [
        'id' => 'string',
    ];

    public static function newFactory(): TaskFactory
    {
        return new TaskFactory();
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(CategoryModel::class, 'task_categories', 'task_id', 'category_id');
    }

    public function newCollection(array $models = []): TaskModelCollection
    {
        return new TaskModelCollection($models);
    }

    public function getCategories(): CategoryModelCollection
    {
        return ($this->relationLoaded('categories') ? $this->categories : new CategoryModelCollection());
    }

    public function toTask(): Task
    {
        return new Task(
            id:     $this->id,
            name:   $this->name,
        );
    }
}
