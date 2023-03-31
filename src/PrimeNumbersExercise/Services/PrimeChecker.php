<?php

declare(strict_types=1);

namespace PrimeNumbersExercise\Services;

use PrimeNumbersExercise\Interfaces\PrimeCheckerInterface;

/**
 * Class PrimeChecker
 */
class PrimeChecker implements PrimeCheckerInterface
{
    /**
     * @param  int  $number The number to check if it's prime
     * @return bool
     */
    public function __invoke(int $number): bool
    {
        
        if (! is_int($number)) {
            return false;
        }

        
        if ($number <= 1) {
            return false;
        }

        // Loop from 2 to the sqrt of the number
        for ($i = 2; $i <= sqrt($number); $i++) {
            if ($number % $i == 0) {
                return false;
            }
        }

        return true;
    }
}
