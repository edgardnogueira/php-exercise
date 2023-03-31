<?php

declare(strict_types=1);

namespace AbTestingExercise\Services;

use AbTestingExercise\Interfaces\AbTestInterface;
use AbTestingExercise\Interfaces\CacheInterface;
use AbTestingExercise\Interfaces\CalcABInterface;
use AbTestingExercise\Interfaces\RedirectorInterface;
use Exads\ABTestData;

/**
 * Class ABTest
 *
 * This class is responsible for running the AB test and redirecting the user to the correct design
 */
class ABTest implements AbTestInterface
{
    private $designs;

    public $abTestData;

    /**
     * ABTest constructor.
     *
     * @param  int  $promotionId
     * @param  CalcABInterface  $calcAB
     * @param  RedirectorInterface  $redirector
     * @param  CacheInterface  $cache
     * @param  ABTestData|null  $abTestData
     */
    public function __construct(
        private int $promotionId,
        private CalcABInterface $calcAB,
        private RedirectorInterface $redirector,
        private CacheInterface $cache,
        ABTestData $abTestData = null)
    {
        try {
            $this->abTestData = $abTestData ?: new ABTestData($this->promotionId);
        } catch (\Exception $e) {
            throw new \App\Exceptions\DefaultException('Problem ABTestData. '.$e->getMessage());
        }
    }

    /**
     * Run the AB test
     *
     * @return string|null
     */
    public function run(): ?string
    {
        // Create a unique key for the session
        $sessionKey = $this->abTestData->getPromotionName().'_'.$this->promotionId;

        // Check if the user has already been redirected to a design
        if ($this->cache->has($sessionKey)) {
            return $this->redirector->redirectToOption($this->cache->get($sessionKey), true);
        }

        try {
            $this->designs = $this->abTestData->getAllDesigns();
        } catch (\Exception $e) {
            throw new \App\Exceptions\DefaultException('Problem load designs or no designs available. '.$e->getMessage());

            return null;
        }

        // if there are no designs, return null
        if (! is_array($this->designs) || empty($this->designs)) {
            return null;
        }

        // if there is only one design, return it
        if (count($this->designs) === 1) {
            $selectedOption = $this->designs[0];
        }

        // if there are more than one design, run the AB test
        if (empty($selectedOption)) {
            $selectedOption = $this->calcAB->run($this->designs);
        }

        if ($selectedOption) {
            $this->cache->set($sessionKey, $selectedOption); // Store the option

            return $this->redirector->redirectToOption($selectedOption, false);
        }

        return null;
    }
}
