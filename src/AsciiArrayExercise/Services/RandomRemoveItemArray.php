<?php

declare(strict_types=1);

namespace AsciiArrayExercise\Services;

use AsciiArrayExercise\Interfaces\RandomRemoveItemArrayInterface;

/**
 * RandomRemoveItemArray
 *
 * This class register and removes a random item from an array
 */
class RandomRemoveItemArray implements RandomRemoveItemArrayInterface
{
    private $removedItem;

    /**
     * __construct
     *
     * @param  array  $array
     * @return void
     */
    public function __construct(
        private array &$array,
    ) {
    }

    /**
     * Register and remove random item from array
     *
     * @return void
     */
    public function run(): void
    {
        if (! empty($this->array)) {
            $randomKey = array_rand($this->array);
            $this->removedItem = $this->array[$randomKey];
            unset($this->array[$randomKey]);
        }

    }

    /**
     * Get the value of removedItem
     */
    public function getRemovedItem()
    {
        return $this->removedItem;
    }
}
