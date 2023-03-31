<?php

declare(strict_types=1);

namespace AbTestingExercise\Services;

use AbTestingExercise\Interfaces\CalcABInterface;

/**
 * Class DefaultCalcAB
 * 
 * Calculate the AB test
 * 
 */
class DefaultCalcAB implements CalcABInterface
{
    private $cumulativeWeights;

    private $abData;

    /**
     * @param  array  $array
     * @return array
     */
    public function run($array): array
    {
        if (! is_array($array) || empty($array)) {
            return [];
        }

        $this->abData = $array;
        $this->cumulativeWeights = $this->calculateWeight();

        return $this->selectItemByWeight();
    }

    /**
     * @return array
     */
    public function calculateWeight(): array
    {
        $this->cumulativeWeights = [];
        $weightTotal = 0;

        if (empty($this->abData)) {
            throw new \App\Exceptions\DefaultException('Problem with abData on calculateWeight');
        }

        foreach ($this->abData as $abData) {
            $weightTotal += $abData['splitPercent'];
            $this->cumulativeWeights[] += $weightTotal;
        }

        // check if the total weight is 100
        if ($weightTotal !== 100) {
            throw new \App\Exceptions\DefaultException('The total weight is not 100');
        }

        return $this->cumulativeWeights;
    }

    /**
     * @return array
     */
    public function selectItemByWeight(): array
    {
        $randomWeight = mt_rand(0, end($this->cumulativeWeights) - 1);

        foreach ($this->cumulativeWeights as $i => $weight) {
            if ($randomWeight < $weight) {
                // perform the desired action with the designId
                return $this->abData[$i];
            }
        }
    }

    /**
     * @return array
     */
    public function getCumulativeWeights(): array
    {
        return $this->cumulativeWeights;
    }
}
