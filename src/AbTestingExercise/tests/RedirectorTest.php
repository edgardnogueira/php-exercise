<?php

use AbTestingExercise\Services\DefaultRedirector;
use PHPUnit\Framework\TestCase;

class RedirectorTest extends TestCase
{
    public function testRedirectorWithoutDesignId()
    {
        $redirector = new DefaultRedirector();

        $this->assertNull($redirector->redirectToOption([]), 'Expected null when no designs are provided');
    }

    public function testRedirector()
    {
        $redirector = new DefaultRedirector();

        $this->assertNotNull($redirector->redirectToOption(['splitPercent' => 30, 'designId' => 1]), 'Expected not null when designs are provided');
    }
}
