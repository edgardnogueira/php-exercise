<?php

declare(strict_types=1);

namespace AsciiArrayExercise\Interfaces;

/**
 * Interface RandomRemoveItemArrayInterface
 */
interface RandomRemoveItemArrayInterface
{
    public function run(): void;

    public function getRemovedItem();
}
