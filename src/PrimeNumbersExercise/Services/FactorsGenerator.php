<?php

declare(strict_types=1);

namespace PrimeNumbersExercise\Services;

use PrimeNumbersExercise\Interfaces\FactorsGeneratorInterface;

/**
 * Class FactorsGenerator
 */
class FactorsGenerator implements FactorsGeneratorInterface
{
    /**
     * @param  int  $number number to get its factors
     * @return array
     */
    public function __invoke(int $number): array
    {
        $multiples = [];

        // Add 1 as a factor if the number is greater than 1
        if ($number > 1) {
            $multiples[] = 1;
        }

        for ($i = 2; $i <= $number / 2; $i++) {
            if ($number % $i == 0) {
                $multiples[] = $i;
            }
        }

        // Add the number as a factor
        $multiples[] = $number;

        return $multiples;
    }
}
