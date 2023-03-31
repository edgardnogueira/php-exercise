<?php

declare(strict_types=1);

namespace PrimeNumbersExercise\Interfaces;

/**
 * Interface PrimeCheckerInterface
 */
interface PrimeCheckerInterface
{
    /**
     * @param  int  $number
     * @return bool
     */
    public function __invoke(int $number): bool;
}
