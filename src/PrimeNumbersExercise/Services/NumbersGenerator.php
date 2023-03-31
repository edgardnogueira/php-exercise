<?php

declare(strict_types=1);

namespace PrimeNumbersExercise\Services;

use PrimeNumbersExercise\Interfaces\FactorsGeneratorInterface;
use PrimeNumbersExercise\Interfaces\NumbersGeneratorInterface;
use PrimeNumbersExercise\Interfaces\PrimeCheckerInterface;

/**
 * Class NumbersGenerator
 */
class NumbersGenerator implements NumbersGeneratorInterface
{
    public function __construct(
        private PrimeCheckerInterface $primeChecker,
        private FactorsGeneratorInterface $factorsGenerator
    ) {
    }

    /**
     * @param  int  $begin number to start from
     * @param  int  $end number to end at
     * @return string
     */
    public function __invoke(int $begin, int $end): string
    {
        $output = '';

        for ($i = $begin; $i <= $end; $i++) {
            $output .= $i;

            if (($this->primeChecker)($i)) {
                $output .= '[Prime]';

                continue;
            }

            $output .= '['.implode(',', ($this->factorsGenerator)($i)).']';
        }

        return $output;
    }
}
