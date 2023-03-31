<?php

declare(strict_types=1);

namespace App\Services;

use AsciiArrayExercise\Services\RandomAsciiArray;
use AsciiArrayExercise\Services\RandomRemoveItemArray;

/**
 * Class AsciiArrayExerciseService
 *
 * Service to run the AsciiArrayExercise and return the result that will be used in the view
 */
class AsciiArrayExerciseService
{
    /**
     * @param $begin
     * @param $end
     * @return array
     */
    public function __invoke($begin, $end): array
    {
        try {
            $generator = new RandomAsciiArray($begin, $end);
            $randomAsciiArray = $generator->generate();

            $originalArray = $randomAsciiArray;

            $removableArray = new RandomRemoveItemArray($randomAsciiArray);
            $removableArray->run();
        } catch (\Exception $e) {
            exit($e->getMessage());
        }

        return [
            'originalArray' => implode(', ', $originalArray),
            'randomArrayAfterRemovedItem' => implode(', ', $randomAsciiArray),
            'removedItem' => $removableArray->getRemovedItem(),
        ];
    }
}
