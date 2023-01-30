<?php

namespace Tests\Shared\Infrastructure\Laravel\Persistence\Eloquent;

use Mockery;
use Exception;
use Tests\TestCase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\QueryException;
use Netberry\Shared\Domain\PersistenceTransactionException;
use Netberry\Shared\Infrastructure\Laravel\Persistence\Eloquent\EloquentTransactionWrapper;

class EloquentTransactionWrapperTest extends TestCase
{
    private EloquentTransactionWrapper $wrapper;
    
    protected function setUp(): void
    {
        parent::setUp();
        $this->wrapper = new EloquentTransactionWrapper();
    }

    public function testShouldExecuteCallableUnderTransaction(): void
    {
        $executed = false;
        DB::shouldReceive('beginTransaction')->withNoArgs()->once()->andReturnNull();
        DB::shouldReceive('commit')->withNoArgs()->once()->andReturnNull();
        
        $this->wrapper->__invoke(function()use(&$executed){$executed = true;});

        $this->assertTrue($executed);
    }

    public function testShouldThrowNotQueryExceptionAndRollbackTransaction(): void
    {
        $this->expectException(Exception::class);

        DB::shouldReceive('beginTransaction')->withNoArgs()->once()->andReturnNull();
        DB::shouldReceive('rollback')->withNoArgs()->once()->andReturnNull();

        $this->wrapper->__invoke(fn() => throw new Exception());
    }

    public function testShouldThrowQueryExceptionAndRollbackTransaction(): void
    {
        $this->expectException(PersistenceTransactionException::class);
        
        DB::shouldReceive('beginTransaction')->withNoArgs()->once()->andReturnNull();
        DB::shouldReceive('rollback')->withNoArgs()->once()->andReturnNull();
        
        Log::shouldReceive('critical')
            ->with(Mockery::type('string'), Mockery::type('array'))
            ->once()
            ->andReturnNull();
        
        $this->wrapper->__invoke(fn() => throw new QueryException('', [], new Exception()));
    }
}
