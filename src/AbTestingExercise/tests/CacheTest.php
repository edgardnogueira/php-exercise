<?php

use AbTestingExercise\Services\SessionCache;
use PHPUnit\Framework\TestCase;

class CacheTest extends TestCase
{
    public function testEnableAndDisableCache()
    {
        $cache = new SessionCache();

        $this->assertTrue($cache->isEnabled(), 'Expected cache is disabled');

        $cache->set('key', 'value');

        $this->assertEquals('value', $cache->get('key'), 'Expected cache is enabled and working');

        // disabling cache
        $cache->disable();

        $this->assertFalse($cache->has('key'), 'Expected cache is disabled and has return false.');

        $this->assertNull($cache->get('key'), 'Expected cache is disabled and key return null.');

        $this->assertFalse($cache->isEnabled(), 'Expected cache is disabled');
    }
}
