<?php

declare(strict_types=1);

namespace AbTestingExercise\Interfaces;

/**
 * Interface CalcABInterface
 */
interface CalcABInterface
{
    public function run($arrayData): array;

    public function calculateWeight(): array;

    public function selectItemByWeight(): array;
}
