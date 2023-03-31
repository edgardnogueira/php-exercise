<?php

declare(strict_types=1);

namespace AsciiArrayExercise\Services;

use AsciiArrayExercise\Interfaces\AsciiArrayGeneratorInterface;

/**
 * RandomAsciiArray
 *
 * This class generates an array of random ASCII characters
 */
class RandomAsciiArray implements AsciiArrayGeneratorInterface
{
    private $removedItem;

    private $randomArray;

    /**
     * __construct
     *
     * @param  int|string  $start first ASCII character
     * @param  int|string  $end last ASCII character
     * @return void
     */
    public function __construct(
        private $start,
        private $end,
    ) {
    }

    /**
     * generate random ASCII array
     *
     * @return array
     */
    public function generate(): array
    {
        $randomAsciiArray = [];
        for ($i = ord($this->start); $i <= ord($this->end); $i++) {
            $randomAsciiArray[] = chr($i);
        }

        shuffle($randomAsciiArray);

        return $randomAsciiArray;
    }

    public function __toString()
    {
        return implode(',', $this->generate());
    }
}
