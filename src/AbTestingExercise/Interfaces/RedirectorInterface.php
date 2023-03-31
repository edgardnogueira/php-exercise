<?php

declare(strict_types=1);

namespace AbTestingExercise\Interfaces;

/**
 * Interface RedirectorInterface
 */
interface RedirectorInterface
{
    public function redirectToOption(array $option, $previouslyRedirected = false);
}
