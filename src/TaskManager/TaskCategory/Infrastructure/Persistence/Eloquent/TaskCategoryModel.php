<?php

declare(strict_types=1);

namespace Netberry\TaskManager\TaskCategory\Infrastructure\Persistence\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Netberry\TaskManager\TaskCategory\Domain\TaskCategory;

class TaskCategoryModel extends Model
{
    use HasFactory;

    protected $table = 'task_categories';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'integer';
    public $timestamps = false;
    protected $fillable = [
        'task_id',
        'category_id',
    ];

    protected $casts = [];

    public static function newFactory(): TaskCategoryFactory
    {
        return new TaskCategoryFactory();
    }

    public function toTaskCategory(): TaskCategory
    {
        return new TaskCategory(
            taskId:     $this->task_id,
            categoryId:   $this->category_id,
        );
    }
}
