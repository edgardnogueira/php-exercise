<?php

declare(strict_types=1);

namespace App\Services;

use AbTestingExercise\Services\ABTest;
use AbTestingExercise\Services\DefaultCalcAB;
use AbTestingExercise\Services\DefaultRedirector;
use AbTestingExercise\Services\SessionCache;

/**
 * Class ABTestingExerciseService
 *
 * Service to run the AB Testing exercise (AbTestingExercise) and return the result that will be used in the view
 */
class ABTestingExerciseService
{
    /**
     * @return array
     */
    public function __invoke(): array
    {
        try {
            $calcAB = new DefaultCalcAB();
            $redirector = new DefaultRedirector();
            $cache = new SessionCache();

            // Change the promoId to test different scenarios
            $promoId = isset($_GET['promoId']) ? intval($_GET['promoId']) : 1;

            // check if user pass disable cache
            if (isset($_GET['disable'])) {
                $cache->disable();
            }

            $abTest = new ABTest($promoId, $calcAB, $redirector, $cache);

            $content = $abTest->run();
        } catch (\App\Exceptions\DefaultException $e) {
            exit($e->getMessage());
        } catch (\Exception $e) {
            exit($e->getMessage());
        }

        return [
            'content' => $content ?? null,
            'promoId' => $promoId ?? null,
            'cache' => $cache->isEnabled() ?? null,
        ];
    }
}
