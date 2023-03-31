<?php

declare(strict_types=1);

namespace AbTestingExercise\Interfaces;

interface CacheInterface
{
    public function set(string $key, $value): void;

    public function get(string $key);

    public function has(string $key): bool;

    public function disable(): void;

    public function isEnabled(): bool;
}
