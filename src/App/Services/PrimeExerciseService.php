<?php

declare(strict_types=1);

namespace App\Services;

use PrimeNumbersExercise\Services\FactorsGenerator;
use PrimeNumbersExercise\Services\NumbersGenerator;
use PrimeNumbersExercise\Services\PrimeChecker;

/**
 * Class PrimeExerciseService
 *
 * Service to run the PrimeExercise and return the result that will be used in the view
 */
class PrimeExerciseService
{
    /**
     * @param $begin
     * @param $end
     * @return array
     */
    public function __invoke($begin, $end): array
    {
        $primeChecker = new PrimeChecker();
        $factorsGenerator = new FactorsGenerator();

        $numbers = new NumbersGenerator($primeChecker, $factorsGenerator);

        return [
            'numbers' => $numbers($begin, $end),
        ];
    }
}
