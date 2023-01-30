<?php

declare(strict_types=1);

namespace Netberry\TaskManager\Category\Infrastructure\Persistence\Eloquent;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Netberry\TaskManager\Category\Domain\Category;

class CategoryModel extends Model
{
    use HasFactory;
    
    protected $table = 'categories';
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

    public static function newFactory(): CategoryFactory
    {
        return new CategoryFactory();
    }

    public function newCollection(array $models = []): CategoryModelCollection
    {
        return new CategoryModelCollection($models);
    }

    public function toCategory(): Category
    {
        return new Category(
            id:     $this->id,
            name:   $this->name,
        );
    }
}
