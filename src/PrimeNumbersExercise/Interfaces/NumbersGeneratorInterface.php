<?php

declare(strict_types=1);

namespace PrimeNumbersExercise\Interfaces;

/**
 * Interface NumbersGeneratorInterface
 */
interface NumbersGeneratorInterface
{
    /**
     * @param  int  $begin
     * @param  int  $end
     * @return string
     */
    public function __invoke(int $begin, int $end): string;
}
