<?php

declare(strict_types=1);

namespace AbTestingExercise\Services;

use AbTestingExercise\Interfaces\RedirectorInterface;

/**
 * Class DefaultRedirector
 */
class DefaultRedirector implements RedirectorInterface
{
    /**
     * Redirect to option (in this exercise using designId)
     * 
     * @param array $option
     * @param bool $previouslyRedirected
     * @return string|null
     */
    public function redirectToOption(array $option, $previouslyRedirected = false)
    {
        if (empty($option['designId'])) {
            return null;
        }

        // Redirection logic
        return 'Show user content of designId: '.$option['designId'].($previouslyRedirected ? ' - Previously Redirected' : null).PHP_EOL;
    }
}
