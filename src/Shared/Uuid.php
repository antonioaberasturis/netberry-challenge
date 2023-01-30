<?php

declare(strict_types=1);

namespace Netberry\Shared;

use Illuminate\Support\Str;
use InvalidArgumentException;

class Uuid
{
    public function __construct(
        protected string $value
    ) {
        $this->ensureIsValidUuid($value);
    }

    public static function new(): self
    {
        return new static(Str::uuid()->toString());
    }

    public function value(): string
    {
        return $this->value;
    }

    public function equals(Uuid $other): bool
    {
        return $this->value() === $other->value();
    }

    public function __toString(): string
    {
        return $this->value();
    }

    private function ensureIsValidUuid(string $id): void
    {
        if (!Str::isUuid($id)) {
            throw new InvalidArgumentException(sprintf('<%s> does not allow the value <%s>.', static::class, $id));
        }
    }
}
