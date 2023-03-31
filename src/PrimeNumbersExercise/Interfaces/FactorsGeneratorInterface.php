<?php

declare(strict_types=1);

namespace PrimeNumbersExercise\Interfaces;

/**
 * Interface FactorsGeneratorInterface
 */
interface FactorsGeneratorInterface
{
    /**
     * @param  int  $number
     * @return array
     */
    public function __invoke(int $number): array;
}
